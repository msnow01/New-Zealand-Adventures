<script src="https://cdn.tiny.cloud/1/<TINYMCEID>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
tinymce.init({
  selector: 'textarea',
  width: 750,
  height: 450,
  remove_linebreaks : true,
  plugins: [
    'advlist autolink link lists charmap print preview hr image anchor pagebreak spellchecker',
    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
    'table emoticons template paste help'
  ],
  toolbar: 'undo redo | styleselect | bold | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullpage | ' +
    'forecolor backcolor emoticons | help',
  menu: {
    favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | link'}
  },
  menubar: 'favs file edit view insert format tools table help',
  content_css: 'css/content.css'
});

$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
</script>
