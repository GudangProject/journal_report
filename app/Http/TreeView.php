<?php

namespace App;

use Illuminate\Http\Request;
use App\Models\Admin\Post\PostCategories;
use App\Models\Admin\Archive\ArchiveCategories;
use App\Models\Admin\Service\ServiceCategories;
use Carbon\Carbon;

class TreeView {
  public static function treeDataOption($tree,$parent,$p,$slc){
      $str = '';
      if(isset($tree[$parent])){
          $s = $p + 1;
          foreach($tree[$parent] as $k=>$v){
              $child    = self::treeDataOption($tree,$v['category_id'],$s,$slc);
              $vPixel   = ($s*2);
              $j = '';
              for($i=0;$i<$vPixel;$i++){
                  $j .= '&nbsp;';
              }
              $awalan = '';
              $akhiran = '';
              if($v['parent_id'] != 0){
                  $awalan   = $j.'--- ';
                  $akhiran  = ' ---';
              }
              $disable = '';
              if($v['status'] == 'h'){
                $disable = ' disabled';
              }
              $str .= '<option value="'.$v['category_id'].'"';
              if($slc == $v['category_id']){
                 $str .= ' selected';
              }
              $str .= ''.$disable.'>'.$awalan.$v['name'].$akhiran.'</option>';
              $str .= $awalan.$v['name'].$akhiran;
              if($child) $str .= $child;
          }
      }
      return $str;
  }
//   public static function treeDataSlug($tree,$parent,$p,$slc){
//     $str = '';
//     if(isset($tree[$parent])){
//         $s = $p + 1;
//         foreach($tree[$parent] as $k=>$v){
//             $child    = self::treeDataSlug($tree,$v['category_id'],$s,$slc);
//             $vPixel   = ($s*2);
//             $j = '';
//             for($i=0;$i<$vPixel;$i++){
//                 $j .= '&nbsp;';
//             }
//             $awalan = '';
//             $akhiran = '';
//             if($v['parent_id'] != 0){
//                 $awalan   = $j.'--- ';
//                 $akhiran  = ' ---';
//             }
//             $disable = '';
//             if($v['status'] == 'h'){
//               $disable = ' disabled';
//             }
//             $str .= '<option value="'.$v['slug'].'"';
//             if($slc == $v['slug']){
//                $str .= ' selected';
//             }
//             $str .= ''.$disable.'>'.$awalan.$v['name'].$akhiran.'</option>';
//             $str .= $awalan.$v['name'].$akhiran;
//             if($child) $str .= $child;
//         }
//     }
//     return $str;
// }
//   public static function treeViewTable($tree,$parent,$p,$url){
//       $str = '';
//       if(isset($tree[$parent])){
//           $s = $p + 1;
//           foreach($tree[$parent] as $k=>$v){
//               $child    = self::treeViewTable($tree,$v['category_id'],$s,$url);
//               $vPixel   = ($s*5);
//               $awalan   = '';
//               $akhiran  = '';
//               if($v['parent_id'] != 0){
//                   $awalan = '<span style="padding-left:'.$vPixel.'px;">--- ';
//                   $akhiran  = ' ---<span>';
//               }
//               $str .= '<tr id="'.$v['category_id'].'">';
//               $str .= '<td>';
//                   $str .= '<div class="checkbox checkbox checkbox-silver checkbox-circle checkboxTmargin">';
//                       $str .= '<input type="checkbox" name="id[]" value="'.$v['category_id'].'" id="'.$v['category_id'].'" class="styled">';
//                       $str .= '<label for="'.$v['category_id'].'"></label>';
//                   $str .= '</div>';
//               $str .= '</td>';
//               $str .= '<td>'.$awalan.$v['name'].$akhiran.'</td>';
//               $str .= '<td>'.$v['slug'].'</td>';
//             //   $str .= '<td>'.$v['add_by'].'</td>';
//             //   $str .= '<td>'.Carbon::parse($v['add_date'])->format('d/m/Y H:i:s').'</td>';
//             //   $str .= '<td>'.$v['edit_by'].'</td>';
//             //   $str .= '<td>'.Carbon::parse($v['edit_date'])->format('d/m/Y H:i:s').'</td>';
//               $str .= '<td class="';
//               if($v['status_code'] == 'p'){
//                 $str .= 'text-primary';
//               }else{
//                 $str .= 'text-danger';
//               }
//               $str .= '">'.$v['status'].'</td>';
//               $str .= '<td>';
//                 $str .= '<div class="btn-group btn-group-xs" role="group" aria-label="Action">';
//                     $str .= '<a class="btn btn-xs btn-default" href="'.$url.$v['category_id'].'" title="Edit"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
//                     if($v['no'] > 1){
//                         $str .= '<a class="btn btn-xs btn-primary" dataAttr="'.$v['category_id'].'" id="mu" href="javascript:void(0);" title="Move Up"><span class="fa fa-arrow-up" aria-hidden="true"></span></a>';
//                     }
//                     $max_no = PostCategories::where('parent_id',$v['parent_id'])->max('no');
//                     if($v['no'] < $max_no){
//                         $str .= '<a class="btn btn-xs btn-warning" dataAttr="'.$v['category_id'].'" id="md" href="javascript:void(0);" title="Move Down"><span class="fa fa-arrow-down" aria-hidden="true"></span></a>';
//                     }
//                 $str .= '</div>';
//               $str .= '</td>';
//               $str .= '</tr>';
//               if($child) $str .= $child;
//           }
//       }
//       return $str;
//   }
//   public static function treeCategoryIcon($tree,$parent,$p,$url){
//     $str = '';
//     if(isset($tree[$parent])){
//         $s = $p + 1;
//         foreach($tree[$parent] as $k=>$v){
//             $child    = self::treeCategoryIcon($tree,$v['category_id'],$s,$url);
//             $vPixel   = ($s*5);
//             $awalan   = '';
//             $akhiran  = '';
//             if($v['parent_id'] != 0){
//                 $awalan = '<span style="padding-left:'.$vPixel.'px;">--- ';
//                 $akhiran  = ' ---<span>';
//             }
//             $str .= '<tr id="'.$v['category_id'].'">';
//             $str .= '<td>';
//                 $str .= '<div class="checkbox checkbox checkbox-silver checkbox-circle checkboxTmargin">';
//                     $str .= '<input type="checkbox" name="id[]" value="'.$v['category_id'].'" id="'.$v['category_id'].'" class="styled">';
//                     $str .= '<label for="'.$v['category_id'].'"></label>';
//                 $str .= '</div>';
//             $str .= '</td>';
//             // $str .= '<td>';
//             //     $str .= '<img src="'.config('app.STORAGE_SERVICES').$v['picture'].'" style="max-width: 40px;"/>';
//             // $str .= '</td>';
//             $str .= '<td>'.$awalan.$v['name'].$akhiran.'</td>';
//             $str .= '<td>'.$v['slug'].'</td>';
//             $str .= '<td class="';
//             if($v['status_code'] == 'p'){
//               $str .= 'text-primary';
//             }else{
//               $str .= 'text-danger';
//             }
//             $str .= '">'.$v['status'].'</td>';
//             $str .= '<td>';
//               $str .= '<div class="btn-group btn-group-xs" role="group" aria-label="Action">';
//                   $str .= '<a class="btn btn-xs btn-default" href="'.$url.$v['category_id'].'" title="Edit"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
//                   if($v['no'] > 1){
//                       $str .= '<a class="btn btn-xs btn-primary" dataAttr="'.$v['category_id'].'" id="mu" href="javascript:void(0);" title="Move Up"><span class="fa fa-arrow-up" aria-hidden="true"></span></a>';
//                   }
//                   $max_no = ServiceCategories::where('parent_id',$v['parent_id'])->max('no');
//                   if($v['no'] < $max_no){
//                       $str .= '<a class="btn btn-xs btn-warning" dataAttr="'.$v['category_id'].'" id="md" href="javascript:void(0);" title="Move Down"><span class="fa fa-arrow-down" aria-hidden="true"></span></a>';
//                   }
//               $str .= '</div>';
//             $str .= '</td>';
//             $str .= '</tr>';
//             if($child) $str .= $child;
//         }
//     }
//     return $str;
// }
//   public static function treeViewArchiveTable($tree,$parent,$p){
//       $str = '';
//       if(isset($tree[$parent])){
//           $s = $p + 1;
//           foreach($tree[$parent] as $k=>$v){
//               $child    = self::treeViewArchiveTable($tree,$v['category_id'],$s);
//               $vPixel   = ($s*5);
//               $awalan   = '';
//               $akhiran  = '';
//               if($v['parent_id'] != 0){
//                   $awalan = '<span style="padding-left:'.$vPixel.'px;">--- ';
//                   $akhiran  = ' ---<span>';
//               }
//               $str .= '<tr id="'.$v['category_id'].'">';
//               $str .= '<td>';
//                   $str .= '<div class="checkbox checkbox checkbox-silver checkbox-circle checkboxTmargin">';
//                       $str .= '<input type="checkbox" name="id[]" value="'.$v['category_id'].'" id="'.$v['category_id'].'" class="styled">';
//                       $str .= '<label for="'.$v['category_id'].'"></label>';
//                   $str .= '</div>';
//               $str .= '</td>';
//               $str .= '<td>'.$awalan.$v['name'].$akhiran.'</td>';
//               $str .= '<td>'.$v['slug'].'</td>';
//               $str .= '<td>'.$v['add_by'].'</td>';
//               $str .= '<td>'.Carbon::parse($v['add_date'])->toDayDateTimeString().'</td>';
//               $str .= '<td>'.$v['edit_by'].'</td>';
//               $str .= '<td>'.Carbon::parse($v['edit_date'])->toDayDateTimeString().'</td>';
//               $str .= '<td class="';
//               if($v['status_code'] == 'p'){
//                 $str .= 'text-primary';
//               }else{
//                 $str .= 'text-danger';
//               }
//               $str .= '">'.$v['status'].'</td>';
//               $str .= '<td>';
//                 $str .= '<div class="btn-group btn-group-xs" role="group" aria-label="Action">';
//                     $str .= '<a class="btn btn-default" href="tcms/archive/kategori/edit/'.$v['category_id'].'" title="Edit"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
//                     if($v['no'] > 1){
//                         $str .= '<a class="btn btn-warning" dataAttr="'.$v['category_id'].'" id="mu" href="javascript:void(0);" title="Move Up"><span class="fa fa-arrow-up" aria-hidden="true"></span></a>';
//                     }
//                     $max_no = ArchiveCategories::where('parent_id',$v['parent_id'])->max('no');
//                     if($v['no'] < $max_no){
//                         $str .= '<a class="btn btn-warning" dataAttr="'.$v['category_id'].'" id="md" href="javascript:void(0);" title="Move Down"><span class="fa fa-arrow-down" aria-hidden="true"></span></a>';
//                     }
//                 $str .= '</div>';
//               $str .= '</td>';
//               $str .= '</tr>';
//               if($child) $str .= $child;
//           }
//       }
//       return $str;
//   }
//   public static function treeDataMenuApi($tree,$parent,$p){
//       $str = array();
//       if(isset($tree[$parent])){
//           $s = $p + 1;
//           $c = 0;
//           foreach($tree[$parent] as $k=>$v){

//               $str[$c]['id'] = $v['category_id'];
//               if($v['category_id'] == 63){
//                   $url = 'https://islam.nu.or.id';
//               }elseif($v['category_id'] == 91){
//                   $url = 'https://mitra.nu.or.id';
//               }else{
//                   $url = '/post/'.$v['category_id'].'/'.self::titleURL($v['slug']);
//               }
//               $str[$c]['url'] = $url;
//               $str[$c]['name'] = self::isHtmlentityDecode($v['name']);
//               $str[$c]['parent_id'] = self::isHtmlentityDecode($v['parent_id']);
//               $child    = self::treeDataMenuApi($tree,$v['category_id'],$s);
//               if($child){
//                   $str[$c]['children'] = $child;
//               };
//               $c++;
//           }
//       }
//       return $str;
//   }
//   public static function treeDataMenuKanal($tree,$parent,$p){
//       $str = '<ul class="sub-menu">';
//       if(isset($tree[$parent])){
//           $s = $p + 1;
//           foreach($tree[$parent] as $k=>$v){
//               $url = '/post/'.$v['category_id'].'/'.self::titleURL($v['slug']);
//               $str .= '<li><a href="'.$url.'">'.self::isHtmlentityDecode($v['name']).'</a>';
//               $child    = self::treeDataMenuKanal($tree,$v['category_id'],$s);
//               if($child) $str .= $child;
//           }
//       }
//       $str .= '</ul>';
//       return $str;
//   }
//   public static function treeDataIndeks($tree,$parent,$p,$slug){
// 		  $str = '';
//         if(isset($tree[$parent])){
//             $s = $p + 1;
//             foreach($tree[$parent] as $k=>$v){
// 				        $css = ($slug == '') ? '' : $slug;
//                 $url = '/indeks/'.$v['slug'].'/';
//                 $str .= '<li><a href="'.$url.'" data-var="'.$v['category_id'].'"  class="'.($css == $v['slug'] ? 'selected': '').'">'.self::isHtmlentityDecode($v['name']).'</a>';
//                 $child    = self::treeDataIndeks($tree,$v['category_id'],$s,$slug);
//                 if($child) $str .= '<ul>' . $child . '</ul>';
// 				$str .= '</li>';
//             }
//         }
//         return $str;
//   }
//   public static function cekParent($id){
//       $row = PostCategories::where('parent_id',$id)->where('status','p')->where('lang',session('lang'))->count();
//       return $row;
//   }
//   public static function isHtmlentityDecode($string){
//       if(!empty($string)){
//     $rep = array('&lt;', '&gt;');
//           $stm = html_entity_decode(htmlspecialchars_decode($string), ENT_QUOTES, "UTF-8");
//     $isi = str_replace($rep, '', $stm);
//           return $isi;
//       }
//   }
//   public static function titleURL($text){
//       $judul1 = self::isHtmlentityDecode($text);
//       $judul2 = str_replace(' ','-',strip_tags($judul1));
//       $judul = preg_replace('/[^A-Za-z0-9\-+]/', '', $judul2);

//       return urldecode($judul);
//   }
//   public static function titikMenu($tree){
//       $str = '';
//       if(is_array($tree)){
//           $str .= '<li class="menu-item-has-children pull-right"><a href="#">more</a>';
//           $str .= '<span class="top_sub_menu_toggle"></span>
//                       <ul class="sub-menu pull-right">';
//           foreach($tree as $k=>$v){
//               $url = '/post/'.$v['category_id'].'/'.self::titleURL($v['slug']);
//               $str .= '<li><a href="'.$url.'">'.$v['name'].'</a></li>';
//           }
//           $str .= '</ul></li>';
//       }
//       $str .= '<li class="indeks"><a href="/indeks">Indeks</a></li>';
//       return $str;
//   }
//   public static function treeDataMenuFront($tree,$parent,$p){
//       $str = '<ul';
//       if($p == 0){
//           $str .= ' class="menu"';
//       }else{
//           if(self::cekParent($parent) > 0){
//               $str .= ' class="sub-menu"';
//           }
//       }
//       $str .= '>';
//       if($p == 0){
//           $str .= '<li class="beranda"><a href="/" title="Beranda - Nahdlatul Ulama"><i class="fa fa-home"></i></a></li>';
//       }
//       $ms = 0;
//       $dataArray = array();
//       if(isset($tree[$parent])){
//           $s = $p + 1;
//           foreach($tree[$parent] as $k=>$v){
//               if($k < 10){
//                   $url = '/post/'.$v['category_id'].'/'.self::titleURL($v['slug']);
//                   $str .= '<li';
//                   if($v['parent_id'] == 0 && self::cekParent($v['category_id']) > 0){
//                       $str .= ' class="menu-item-has-children pull-right"';
//                   }
//                   $str .= '><a href="'.$url.'">'.self::isHtmlentityDecode($v['name']).'';
//                   if(self::cekParent($v['category_id']) > 0){
//                       $str .= '<span class="top_sub_menu_toggle"></span>';
//                   }
//                   $str .= '</a>';
//                   $child    = self::treeDataMenuFront($tree,$v['category_id'],$s);
//                   if($child) $str .= $child;
//               }else{
//                   $dataArray[] = $v;
//                   $ms = 1;
//               }
//           }
//       }
//       if($ms > 0){
//           $str .= self::titikMenu($dataArray);
//       }
//       $str .= '</ul>';
//       return $str;
//   }
}
