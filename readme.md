# UniSharp laravel-filemanager


## 1. composer require unisharp/laravel-filemanager

## 2. 
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public

## 3.
resources\views\admin\create.blade.php:
@include ("includes.tinyeditor")

## 4.
resources\views\includes\tinyeditor.blade.php:
<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> -->
<!-- <script>tinymce.init({ selector:'textarea' });</script> -->

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>


  var editor_config = {
    path_absolute : "/",
    //selector: "textarea.my-editor",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);

</script>


## 5.

composer require intervention/image


## 6.
to see the image on the post.blade.php
replace {{$post->body}}
with <p>{!! $post->body !!}</p>

## 7.

_______________________________________________________
# bulk media delete:

## 1.
routes/web.php:

Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');

## 2.
resources/views/media/index.blade.php:

    <form action="delete/media" method="post" class="form-inline">
        <div class="form-group">

        {{csrf_field()}}
        {{method_field('delete')}}

            <select name="checkBoxArray" id="">
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn-primary" >
        </div>

TABLE 
(add 
<th ><input type="checkbox" id="options"></th>
<td ><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{ $photo->id}}"></td>)

</form>

## 3.
adminMediasController:    

public function deleteMedia(Request $request){

        $photos = Photo::findOrFail($request->checkBoxArray);

        foreach($photos as $photo){
            $photo->delete();   
        }
        return redirect()->back();

    }





