<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AllowedFileType: string
{
    use EnumToArray;

    case JPEG = 'jpeg';
    case JPG = 'jpg';
    case GIF = 'gif';
    case PNG = 'png';
    case PDF = 'pdf';
    case DOC = 'doc';
    case XLS = 'xls';
    case PPT = 'ppt';
    case SVG = 'svg';
    case MP3 = 'mp3';
    case MP4 = 'mp4';
    case ZIP = 'zip';
}
