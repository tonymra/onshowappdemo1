<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename, $stream=TRUE,$orientation='portrait') 
{                                                 
    require_once("dompdf/dompdf_config.inc.php");
    spl_autoload_register('DOMPDF_autoload');
    
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A4',$orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename);
    } else {
        $CI =& get_instance();
        $CI->load->helper('file');
        write_file($filename, $dompdf->output());
    }
}
?>