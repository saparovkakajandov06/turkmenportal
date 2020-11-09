<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="haryt-image template-download fade">
        {% if (file.error) { %}
            <div class="preview error">{% if (file.name) { %}
                <span class="name"><b>{%=file.name%}</b></span>
                <span class="error label label-important"><i>{%=locale.fileupload.error%}</i> {%=locale.fileupload.errors[file.error] || file.error%}</span>
            {% } %}</div>
        {% } else { %}
            <div class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</div>
            
        {% } %}
        <div class="delete" style="position: absolute; top: 0px; right: 0px;">
            <button style="margin: 0px;" class="btn" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="fa fa-times icon-white"></i>
            </button>
        </div>
    </div>
    
{% } %}
</script>
