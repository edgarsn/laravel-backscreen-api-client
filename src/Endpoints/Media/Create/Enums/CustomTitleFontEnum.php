<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums;

enum CustomTitleFontEnum: string
{
    case ARIAL = 'Arial, Helvetica, sans-serif';
    case TIMES_NEW_ROMAN = "'Times New Roman', Times, serif";
    case COURIER_NEW = "'Courier New', Courier, monospace";
    case VERDANA = 'Verdana, Geneva, sans-serif';
    case GEORGIA = "Georgia, 'Times New Roman', Times, serif";
    case PALATINO = "'Palatino Linotype', 'Book Antiqua', Palatino, serif";
    case COMIC_SANS = "'Comic Sans MS', Textile, cursive";
    case TREBUCHET = "'Trebuchet MS', Helvetica, sans-serif";
    case ARIAL_BLACK = "'Arial Black', Gadget, sans-serif";
    case IMPACT = 'Impact, Charcoal, sans-serif';
}
