<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("library/editor.md/css/editormd.css") }}">
</head>
<style>
    .editormd-fullscreen {
        z-index: 10;
    }
    .CodeMirror-cursor{
        min-width: 10px;
    }
</style>
<body>
@yield('content')

<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.js") }}"></script>
<script src="{{ asset("library/editor.md/editormd.js") }}"></script>

<script>
    var mdEditor;
    $(function () {
        mdEditor = editormd("post-content", {
            width: "100%",
            height: 540,
            path: '{{ asset('library/editor.md/lib') }}/',
            theme: "default",
            editorTheme: "3024-day",
            // previewTheme: "default",
            // markdown: md,
            codeFold: true,
            syncScrolling: true,
            saveHTMLToTextarea: true,    // 保存 HTML 到 Textarea
            searchReplace: true,
            watch: false,                // 关闭实时预览
            htmlDecode: "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
            // toolbar: false,             //关闭工具栏
            previewCodeHighlight: true, // 关闭预览 HTML 的代码块高亮，默认开启
            emoji: true,
            taskList: true,
            tocm: true,         // Using [TOCM]
            tex: true,                   // 开启科学公式TeX语言支持，默认关闭
            flowChart: true,             // 开启流程图支持，默认关闭
            sequenceDiagram: true,       // 开启时序/序列图支持，默认关闭,
            //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
            //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
            //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
            //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
            //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
            imageUpload: true,
            imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL: "{{ route('post.image_upload') }}",
            toolbarHandlers: {
                dataSubmit: function (cm, icon, cursor, selection) {
                    $("#post-content").closest("form").submit();
                },
            },
            toolbarCustomIcons: {
                dataSubmit: '{!! Form::submit("保存文章",['class'=>'btn btn-info btn-sm']) !!}',
            },
            onload: function () {
                console.log('onload', this);
                this.fullscreen();
                // this.unwatch();
                // this.watch().fullscreen();

                //this.setMarkdown("#PHP");
                //this.width("100%");
                //this.height(480);
                //this.resize("100%", 640);
            }
        });

    })
</script>
{{--<script src="{{ asset("library/editor.md/lib/codemirror/keymap/vim.js") }}"></script>--}}
</body>
</html>