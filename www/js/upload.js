const upload = {
    close : function(){
        $('#__drap__progress').remove();
    },
    showError: function(msg){
        $('#__drap__progress_msg').html('<p>'+msg+'</p>');
        $('#__drap__progress_close').css('display', 'inline-block');
    },
    init: function(url, dragAreaID, callback){
        var droparea = document.getElementById(dragAreaID);
        
        if($("#__drap__input").length == 0){
            $('body').append('<input id="__drap__input" type="file" style="display:none;" />');
            var inp = document.getElementById("__drap__input");
            
            inp.addEventListener('change', function(e){
                // ドロップしたファイルの取得
                var files = e.target.files;
                var file = files[0];
                inp.value = null;
                upload._xhr(url, file, callback);
            });
            
            droparea.addEventListener('click', function(e){
                $('#__drap__input').click();
            });
        }
        
        droparea.addEventListener('dragover', function(e){
            e.preventDefault();
            droparea.classList.add('dragover');
        });
        droparea.addEventListener('dragleave', function(e){
            e.preventDefault();
            droparea.classList.remove('dragover');
        });
        
        droparea.addEventListener('drop', function(e){
            e.preventDefault();
            droparea.classList.remove('dragover');
            
            // ドロップしたファイルの取得
            var files = e.dataTransfer.files;
            var file = files[0];
            
            upload._xhr(url, file, callback);
        });
    },
    _xhr : function(url, file, callback){
        if($('#__drap__wrap').length == 0){
            var html = '<div id="__drap__progress" style="position:fixed; background-color:rgba(255,255,255,0.9); top:0;left:0;width:100vw;height:100vh;text-align:center; padding-top:40vh; font-size:1.5rem;">'
                + '<div id="__drap__progress_msg"><p>Uploading...</p><br></div>'
                + '<span id="__drap__progress_close" onclick="upload.close();" style="display:none; margin-top:2rem; padding:.5rem 1.5rem; background-color:#eee; border:1px solid #000; color:#000; font-size:1rem;">Close</span>'
                + '</div>';
            $('body').append(html);
        }
        if(typeof file !== 'undefined') {
            var fd = new FormData();
            fd.append('file', file);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", url);

            // アップロード関連イベント
            xhr.upload.addEventListener('loadstart', (e2) => {
                var ele = document.getElementById("__drap__progress_msg");
                ele.insertAdjacentHTML('beforeend', "<progress max='100' value='0'></progress>");
                /* $('#__drap__progress_msg').append("<progress max='100' value='0'></progress>"); */
            });

            xhr.upload.addEventListener('progress', (e2) => {
              // アップロード進行パーセント
              let percent = (e2.loaded / e2.total * 100).toFixed(1);
              $('#__drap__progress_msg progress').val(percent);
            });

            xhr.upload.addEventListener('abort', (e2) => { upload.showError('Upload Abort'); });
            xhr.upload.addEventListener('error', (e2) => { upload.showError('Upload Failed'); });
            xhr.upload.addEventListener('timeout', (e2) => { upload.showError('Upload Timeout'); });

            xhr.upload.addEventListener('load', (e2) => {
                // 正常終了
                $('#__drap__progress_msg progress').val(100);
            });

            xhr.upload.addEventListener('loadend', (e2) => { 
                // アップロード終了 (エラー・正常終了両方)
            });

            xhr.onload = function(e){
                if(callback != null && callback != undefined){
                    callback(xhr.responseText);
                }else{
                    upload.close();
                }
            };
            xhr.send(fd);
        } else {
            upload.close();
        }
    }
    
}