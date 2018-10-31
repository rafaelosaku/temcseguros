<?php

/**
 * Classe [ HELPER ]
 * Responsável por executar imagens, arquivos e mídias no sistema.
 *
 * @copyright (c) 2015, Rafael Osaku Dev.
 */
class Upload {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD */
    private $Width;
    private $Image;

    /** RESULTSET */
    private $Result;
    private $Error;

    /** DIRETÓRIOS */
    private $Folder;
    private static $BaseDir;

    function __construct($BaseDir = null) {
        self::$BaseDir = ( (string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ( (string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ( (int) $Width ? $Width : 1024 );
        $this->Folder = ( (string) $Folder ? $Folder : 'images' );

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
    }

    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Name = ( (string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ( (string) $Folder ? $Folder : 'files' );
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 2 );

        $FileAccept = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/pdf'
        ];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
            elseif(!in_array($this->File['type'], $FileAccept)):
                $this->Result = false;
                $this->Error = 'Tipo de arquivo não suportado, envie .PDF ou .DOCX';
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }
    
    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Name = ( (string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ( (string) $Folder ? $Folder : 'medias' );
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 40 );

        $FileAccept = [
            'audio/mp3',
            'video/mp4'
        ];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
            elseif(!in_array($this->File['type'], $FileAccept)):
                $this->Result = false;
                $this->Error = 'Tipo de arquivo não suportado, envie arquivos de áudio .mp3 ou ou vídeo .mp4';
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    //PRIVATES
    /**
     * Realiza checagem de diretórios
     * 
     * @param type $Folder
     */
    private function CheckFolder($Folder) {
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }
    
    

    /**
     * Verifica a existência de pasta para upload,
     * caso não haja será criada conforme os parâmetros informados.
     * 
     * @param type $Folder
     */
    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    /**
     * previne a substituição de arquivos repetidos
     * verifica e monta o nome dos arquivos trantando a string.
     */
    private function setFileName() {
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    //Realiza o upload de imagens redimensionando a mesma.
    private function UploadImage() {

        switch ($this->File['type']):
            case 'image/jpg';
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;

            case 'image/png';
            case 'image/x-png';
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;

            case 'image/gif';
                $this->Image = imagecreatefromgif($this->File['tmp_name']);
        endswitch;

        if (!$this->Image):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo inválido, somente são aceitos arquivos do tipo GIF, JPG e PNG';
        else:
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            $ImageX = ( $this->Width < $x ? $this->Width : $x );
            $ImageH = ($ImageX * $y) / $x;

            $NewImage = imagecreatetruecolor($ImageX, $ImageH);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

            switch ($this->File['type']):
                case 'image/jpg';
                case 'image/jpeg';
                case 'image/pjpeg';
                    imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;

                case 'image/png';
                case 'image/x-png';
                    imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;

                case 'image/gif';
                    imagegif($NewImage, self::$BaseDir . $this->Send . $this->Name);
            endswitch;

            if (!$NewImage):
                $this->Result = false;
                $this->Error = 'Tipo de arquivo inválido, somente são aceitos arquivos do tipo GIF, JPG e PNG';
            else:
                $this->Result = $this->Send . $this->Name;
                $this->Error = null;
            endif;

            imagedestroy($this->Image);
            imagedestroy($NewImage);

        endif;
    }

    //ENVIA ARQUIVOS E MÍDIAS
    private function MoveFile() {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        else:
            $this->Result = false;
            $this->Error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
        endif;
    }

}
