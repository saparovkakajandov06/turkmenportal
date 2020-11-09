<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="template-upload fade">
        <div class="preview"><span class="fade"></span></div>
        <div class="name"><span>{%=file.name%}</span></div>
        {% if (file.error) { %}
            <div class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
        {% } else if (o.files.valid && !i) { %}
            <div>
                <div class="progress progress-success  progress-striped active"><div class="bar" style="width:0%;"></div></div>
            </div>
            <div class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</div>
        {% } else { %}
            <div colspan="2"></div>
        {% } %}
        <div class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</div>
    </tr>
{% } %}
</script>


<div class="form-uploader-item js-uploader-item" data-state="progress" draggable="true">
    <span class="form-uploader-progress">
        <div class="progress progress-success progress-striped active"><div class="bar" style="width:50%;"></div></div>
        <span class="form-uploader-progress__bar js-uploader-progress-bar progress progress-success progress-striped active" style="width: 50%;"></span>
    </span>
</div>