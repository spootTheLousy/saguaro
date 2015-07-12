<?php
/*

    Formats images for OPs and replies.

    Shouldn't be used without a parent (post.php).

*/

class Image {
    function format($input) {
        extract($input);

        $imgdir   = IMG_DIR;
        $thumbdir = DATA_SERVER . BOARD_DIR . "/" . THUMB_DIR;
        $cssimg   = CSS_PATH;

        // Picture file name
        $img        = $path . $tim . $ext;
        $displaysrc = DATA_SERVER . BOARD_DIR . "/" . $imgdir . $tim . $ext;
        $linksrc    = ( ( USE_SRC_CGI == 1 ) ? ( str_replace( ".cgi", "", $imgdir ) . $tim . $ext ) : $displaysrc );
        if ( defined( 'INTERSTITIAL_LINK' ) )
            $linksrc = str_replace( INTERSTITIAL_LINK, "", $linksrc );
        $src = IMG_DIR . $tim . $ext;
        if ( $fname == 'image' )
            $fname = time();
        $longname  = $fname;
        $shortname = ( strlen( $fname ) > 40 ) ? substr( $fname, 0, 40 ) . "(...)" . $ext : $longname;
        // img tag creation
        $imgsrc    = "";
        if ( $ext ) {
            // turn the 32-byte ascii md5 into a 24-byte base64 md5
            $shortmd5 = base64_encode( pack( "H*", $md5 ) );
            if ( $fsize >= 1048576 ) {
                $size = round( ( $fsize / 1048576 ), 2 ) . " M";
            } else if ( $fsize >= 1024 ) {
                $size = round( $fsize / 1024 ) . " K";
            } else {
                $size = $fsize . " ";
            }
            if ( !$tn_w && !$tn_h && $ext == ".gif" ) {
                $tn_w = $w;
                $tn_h = $h;
            }
            if ( $spoiler ) {
                $size   = "Spoiler Image, $size";
                $imgsrc = "<br><a href=\"" . $displaysrc . "\" target=_blank><img src=\"" . SPOILER_THUMB . "\" border=0   alt=\"" . $size . "B\" md5=\"$shortmd5\"></a>";
            } elseif ( $tn_w && $tn_h ) { //when there is size...
                if ( @is_file( THUMB_DIR . $tim . 's.jpg' ) ) {
                    $imgsrc = "<a href=\"" . $displaysrc . "\" target=_blank><img class=\"postimg\" src=\"" . $thumbdir . $tim . 's.jpg' . "\" border=0  width=$tn_w height=$tn_h  alt=\"" . $size . "B\" md5=\"$shortmd5\"></a>";
                } else {
                    $imgsrc = "<a href=\"" . $displaysrc . "\" target=_blank><span class=\"tn_thread\" title=\"" . $size . "B\">Thumbnail unavailable</span></a>";
                }
            } else {
                if ( @is_file( THUMB_DIR . $tim . 's.jpg' ) ) {
                    $imgsrc = "<a href=\"" . $displaysrc . "\" target=_blank><img class=\"postimg\" src=\"" . $thumbdir . $tim . 's.jpg' . "\" border=0   alt=\"" . $size . "B\" md5=\"$shortmd5\"></a>";
                } else {
                    $imgsrc = "<a href=\"" . $displaysrc . "\" target=_blank><span class=\"tn_thread\" title=\"" . $size . "B\">Thumbnail unavailable</span></a>";
                }
            }
            /*if ( !is_file( $src ) ) {
                $return .= '<img src="' . $cssimg . 'filedeleted.gif" alt="File deleted.">';
            } else {
                $dimensions = ( $ext == '.pdf' ) ? 'PDF' : "{$w}x{$h}";
                if ( 1 ) {
                    return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"filesize\">" . S_PICNAME . "<a href=\"$linksrc\" target=\"_blank\">$time$ext</a>-(" . $size . "B, " . $dimensions . ", <span title=\"" . $longname . "\">" . $shortname . "</span>)</span>" . $imgsrc;
                } else {
                    return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"filesize\">" . S_PICNAME . "<a href=\"$linksrc\" target=\"_blank\">$time$ext</a>-(" . $size . "B, " . $dimensions . ")</span>" . $imgsrc;
                }
            }*/
            
            return $imgsrc;

            return undefined;
        }
    }
}

?>