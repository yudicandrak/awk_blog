<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
</head>
<body>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/at.js/1.5.4/css/jquery.atwho.min.css">

<div id="froala-editor">
  <p>Froala WYSIWYG Editor can easily be integrated with the amazing <a href="https://ichord.github.io/At.js/" target="_blank" rel="nofollow">At.js library</a>. Type an @ to display the autocomplete list.
  </p>
</div>
 
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/at.js/1.5.4/js/jquery.atwho.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0//js/froala_editor.pkgd.min.js"></script>

<script type="text/javascript">
  $(function() {
    // Define data source for At.JS.
    var datasource = ["Jacob", "Isabella", "Ethan", "Emma", "Michael", "Olivia" ];

    // Build data to be used in At.JS config.
    var names = $.map(datasource, function (value, i) {
      return {
        'id': i, 'name': value, 'email': value + "@email.com"
      };
    });

    // Define config for At.JS.
    var config = {
      at: "@",
      data: names,
      displayTpl: '<li>${name} <small>${email}</small></li>',
      limit: 200
    }

    // Initialize editor.
    $('#froala-editor')
      .on('froalaEditor.initialized', function (e, editor) {
        editor.$el
          .atwho(config)
          .on('inserted.atwho', function () {
            editor.$el.find('.atwho-inserted').removeAttr('contenteditable');
          })

        editor.events.on('keydown', function (e) {
          if (e.which == $.FroalaEditor.KEYCODE.ENTER && editor.$el.atwho('isSelecting')) {
            return false;
          }
        }, true);
      })
      .froalaEditor()
  });
</script>

</body>
</html>