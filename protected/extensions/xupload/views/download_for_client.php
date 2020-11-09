<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="form-uploader-item template-download fade count_{%=i%}">
        {% if (file.error) { %}
            <div class="name"><span>{%=file.name%}</span></div>
            <div class="size"><span>{%=o.formatFileSize(file.size)%}</span></div>
            <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
        {% } else { %}
           {% if (file.thumbnail_url) { %}
                <img src="{%=file.thumbnail_url%}">
            {% } %}
            <input class="js-uploader-item-image-id" type="text" name="XUploadForm[images][]" value="{%=file.name%}">
            <div class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </div>
        {% } %}
        <div class="delete">
            <input type="hidden" name="delete" value="1">
            <button class="btn btn-delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="fa fa-times white"></i>
            </button>
            
        </div>
    </div>
{% } %}
</script>
