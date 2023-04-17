<?php
namespace App\Libraries;
use App\Models\BlogModel;

class Plugins
{
    protected $blog;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
        $this->blog = new BlogModel();
    }

    public function cssDataTables()
    {
        return array(
            "DataTables/DataTables-1.10.22/css/dataTables.bootstrap4.min.css",
            "DataTables/Editor-1.9.5/css/editor.dataTables.min.css",
            "DataTables/Editor-1.9.5/css/editor.bootstrap4.min.css",
            "DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css",
            "DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css",
            "DataTables/Responsive-2.2.6/css/responsive.bootstrap4.min.css"
        );
    }

    public function jsDataTables()
    {
        return array(
            "tinymce/tinymce.min.js",
            "DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js",
            "DataTables/DataTables-1.10.22/js/dataTables.bootstrap4.min.js",
            "DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js",
            "jszip/jszip.min.js",
            "pdfmake/pdfmake.min.js",
            "pdfmake/vfs_fonts.js",
            "DataTables/Buttons-1.6.5/js/buttons.colVis.min.js",
            "DataTables/Buttons-1.6.5/js/buttons.flash.min.js",
            "DataTables/Buttons-1.6.5/js/buttons.html5.min.js",
            "DataTables/Buttons-1.6.5/js/buttons.print.min.js",
            "DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js",
            "DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js",
            "DataTables/Responsive-2.2.6/js/responsive.bootstrap4.min.js",
            "DataTables/Select-1.3.1/js/dataTables.select.min.js",
            "DataTables/Select-1.3.1/js/select.bootstrap4.min.js",
            "DataTables/Editor-1.9.5/js/dataTables.editor.min.js",
            "DataTables/Plugins/editor/editor.display.js",
            "DataTables/Plugins/editor/editor.tinymce.js",
            "DataTables/Plugins/api/sum().js",
            "DataTables/Plugins/dataRender/ellipsis.js"
        );
    }

    public function program_kami(){
        return $this->db->query("SELECT id, nama, url, banner_image, banner_judul, banner_deskripsi FROM program WHERE status=1")->getResult();
    }
    
    public function getTag($id_portfolio){
        $result = $this->db->query("SELECT nama FROM portfolio_tag WHERE id_portfolio=?", array($id_portfolio))->getResult();
        $tag = '';
        foreach($result as $r){
            $tag .= $r->nama.' ';
        }
        
        return $tag;
    }

    public function getTags($id_portfolio){
        $result = $this->db->query("SELECT nama FROM portfolio_tag WHERE id_portfolio=?", array($id_portfolio))->getResult();
        $tag = '';
        foreach($result as $r){
            $tag .= $r->nama.', ';
        }
        
        return rtrim($tag, ', ');
    }

    public function getPrevPortfolio($id_portfolio){
        $result = $this->db->query("SELECT id FROM portfolio WHERE id < ? ORDER BY id DESC LIMIT 1", array($id_portfolio))->getRow();
        if(!empty($result->id)){
            return $result->id;
        }else{
            return false;
        }
    }

    public function getNextPortfolio($id_portfolio){
        $result = $this->db->query("SELECT id FROM portfolio WHERE id > ? ORDER BY id ASC LIMIT 1", array($id_portfolio))->getRow();
        if(!empty($result->id)){
            return $result->id;
        }else{
            return false;
        }
    }

    public function getPrevProduk($id_produk){
        $result = $this->db->query("SELECT id FROM product WHERE id < ? ORDER BY id DESC LIMIT 1", array($id_produk))->getRow();
        if(!empty($result->id)){
            return $result->id;
        }else{
            return false;
        }
    }

    public function getNextProduk($id_produk){
        $result = $this->db->query("SELECT id FROM product WHERE id > ? ORDER BY id ASC LIMIT 1", array($id_produk))->getRow();
        if(!empty($result->id)){
            return $result->id;
        }else{
            return false;
        }
    }

    public function format_tanggal($Tgal,$jam="yes",$idBahasa = 'id'){
		if($Tgal == ""){
			return;
		}

		$tanggal = explode(' ',$Tgal);
		$mdy=explode('-',$tanggal[0]);
		$mBul=$mdy[1];
		
		if($idBahasa == "id"){
	
		    if($mBul=='01'){$isBulan='Jan';}elseif($mBul=='02'){$isBulan='Feb';}
		    elseif($mBul=='03'){$isBulan='Mar';}elseif($mBul=='04'){$isBulan='Apr';}
		    elseif($mBul=='05'){$isBulan='Mei';}elseif($mBul=='06'){$isBulan='Jun';}
		    elseif($mBul=='07'){$isBulan='Jul';}elseif($mBul=='08'){$isBulan='Agu';}
		    elseif($mBul=='09'){$isBulan='Sep';}elseif($mBul=='10'){$isBulan='Okt';}
		    elseif($mBul=='11'){$isBulan='Nop';}elseif($mBul=='12'){$isBulan='Des';}
		    elseif($mBul=='00'){$isBulan='00';}
		    
		    $hasil = $mdy[2].' '.$isBulan.' '.$mdy[0];
		    if(count($tanggal) == 2) {
                if($jam == "yes"){
                    $hasil = $mdy[2].' '.$isBulan.' '.$mdy[0]. ', '. substr($tanggal[1],0,5).' WIB';
                }else{
                    $hasil = $mdy[2].' <span>'.$isBulan.' '.$mdy[0].'</span>';
                }
		    }
		    
		}
		return $hasil;
	}

    public function format_tanggal_sort($Tgal, $jam=NULL){
		if($Tgal == ""){
			return;
		}

		$tanggal = explode(' ',$Tgal);
		$ymd = explode('-',$tanggal[0]);

		$year = $ymd[0];
		$month = $ymd[1];
		$day = $ymd[2];
		
        $hasil = $day.'/'.$month.'/'.$year;

        if(count($tanggal) == 2) {
            if($jam == "yes"){
                $hasil = $ymd[2].'/'.$month.'/'.$ymd[0]. ', '. substr($tanggal[1],0,5).' WIB';
            }else{
                $hasil = $ymd[2].'/'.$month.'/'.$ymd[0];
            }
        }

		return $hasil;
	}

    public function fetch_tag($blog_id){
        $id=htmlspecialchars($blog_id, ENT_QUOTES);
        $result="<div class='d-flex'>";
        $result.="Tags: ";
        foreach($this->blog->fetchTag($id) as $tag){
            $result.="<h5 class='p-1 align-self-center'><span class='badge badge-info'>$tag->name</span></h5>";
        }
        $result.="</div>";
        return $result;
    }

    // public function fetch_tag_all(){
    //     $result="";
    //     foreach($this->berita->fetchTagAll() as $tag){
    //         $result.='<a href="'.base_url('/publikasi/artikel-berita/tags/'.urlencode($tag->name)).'">'.$tag->name.'</a>';
    //     }
    //     return $result;
    // }
    
    public function photo_url_author($user_id){
        $id=htmlspecialchars($user_id, ENT_QUOTES);
        return $this->berita->fetchPhotoUrlAuthor($id);
    }

}
