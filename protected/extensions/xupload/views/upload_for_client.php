<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="form-uploader-item template-upload fade">
        {% if (file.error) { %}
            <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
        {% } else if (o.files.valid && !i) { %}
            <div>
                <div class="progress progress-success progress-animated progress-striped active"><div class="bar" style="width:0%;"></div></div>
            </div>
        
        {% } %}
        <div class="cancel">{% if (!i) { %}
            <button class="btn btn-cancel">
                <i class="fa fa-times white"></i>
            </button>
        {% } %}</div>
    </div>
{% } %}
</script>
