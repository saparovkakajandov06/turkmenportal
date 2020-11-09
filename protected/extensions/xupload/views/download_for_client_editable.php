<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="form-uploader-item template-download editable fade count_{%=i%}">
        {% if (file.error) { %}
            <div class="name"><span>{%=file.name%}</span></div>
            <div class="size"><span>{%=o.formatFileSize(file.size)%}</span></div>
            <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
        {% } else { %}
           {% if (file.thumbnail_url) { %}
                <img src="{%=file.thumbnail_url%}">
            {% } %}
            <input class="js-uploader-item-image-id" type="hidden" name="XUploadForm[images][]" value="{%=file.name%}">
            <div class="name">
               {%=file.name%}
            </div>
        {% } %}
        <div class="delete">
            <input type="hidden" name="delete" value="1">
            <button class="btn btn-delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="fa fa-times white"></i>
            </button>
        </div>
        <div class="edit">
            <a href="{%=file.edit_url%}" return="false"><i class="fa fa-edit white"></i></a>
        </div>
    </div>
{% } %}
</script>
