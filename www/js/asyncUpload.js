let asyncUpload = {
    html:  '<div id="__drap__progress" style="position:fixed; background-color:rgba(255,255,255,0.9); top:0;left:0;width:100vw;height:100vh;text-align:center; padding-top:40vh; font-size:1.5rem;">'
        + '<div id="__drap__progress_msg"><p>Uploading...</p><br></div>'
        + '<span id="__drap__progress_close" onclick="asyncUpload.close();" style="display:none; margin-top:2rem; padding:.5rem 1.5rem; background-color:#eee; border:1px solid #000; color:#000; font-size:1rem;cursor: pointer;">Close</span>'
        + '</div>',
    class_dragover: 'dragover',
    
    close : function(){
        document.getElementById('__drap__progress').remove();
    },
    show: function(msg){
        document.getElementById('__drap__progress_msg').innerHTML = "<p>"+msg+"</p>";
        document.getElementById('__drap__progress_close').style.display = 'inline-block';
    },
    init: function(url, areaId, callback, errCallback){
        
        var droparea = document.getElementById(areaId);
        var maxsize = droparea.getAttribute("data-maxsize");
        if(maxsize === undefined || maxsize === "" ){ maxsize = 0; }
        
        if(document.getElementById('__drap__input') === null){
            document.getElementsByTagName("body")[0]
                    .insertAdjacentHTML("beforeend", '<input id="__drap__input" type="file" style="display:none;" />');
            var inp = document.getElementById("__drap__input");
            
            inp.addEventListener('change', function(e){
                // ドロップしたファイルの取得
                var files = e.target.files;
                var file = files[0];
                inp.value = null;
                asyncUpload.xhr_post(url, file, maxsize, callback, errCallback);
            });
            
            droparea.addEventListener('click', function(e){
                document.getElementById("__drap__input").click();
            });
        }
        
        droparea.addEventListener('dragover', function(e){
            e.preventDefault();
            droparea.classList.add(asyncUpload.class_dragover);
        });
        droparea.addEventListener('dragleave', function(e){
            e.preventDefault();
            droparea.classList.remove(asyncUpload.class_dragover);
        });
        droparea.addEventListener('drop', function(e){
            e.preventDefault();
            droparea.classList.remove(asyncUpload.class_dragover);
            
            // ドロップしたファイルの取得
            var files = e.dataTransfer.files;
            var file = files[0];
            asyncUpload.xhr_post(url, file, maxsize, callback, errCallback);
        });
    },

    xhr_post: function(url, file, maxsize, callback, errCallback){
        if(document.getElementById('__drap__wrap') == null){
            document.getElementsByTagName("body")[0]
                    .insertAdjacentHTML("beforeend", asyncUpload.html);
        }
        if(typeof file !== 'undefined') {
            if(maxsize > 0){
                if(file.size > maxsize){
                    asyncUpload.show('Upload sizeover, should be '+ maxsize +'byte or less.');
                    if(errCallback != null && errCallback != undefined){ errCallback("sizeover"); }
                    return;
                }
            }
            
            var fd = new FormData();
            fd.append('file', file);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", url);

            // アップロード関連イベント
            xhr.upload.addEventListener('loadstart', (e2) => {
                let ele = document.getElementById("__drap__progress_msg");
                ele.insertAdjacentHTML('beforeend', "<progress max='100' value='0'></progress>");
            });

            xhr.upload.addEventListener('progress', (e2) => {
              // アップロード進行パーセント
                let ele = document.getElementById("__drap__progress_msg").getElementsByTagName('progress')[0];
                ele.value = (e2.loaded / e2.total * 100).toFixed(1);
            });

            xhr.upload.addEventListener('abort', (e2) => {
                asyncUpload.show('Upload abort');
                if(errCallback != null && errCallback != undefined){ errCallback("abort"); }
            });
            xhr.upload.addEventListener('timeout', (e2) => {
                asyncUpload.show('Upload timeout');
                if(errCallback != null && errCallback != undefined){ errCallback("timeout"); }
            });
            xhr.upload.addEventListener('error', (e2) => {
                asyncUpload.show('Upload faild');
                if(errCallback != null && errCallback != undefined){ errCallback("faild"); }
            });

            xhr.upload.addEventListener('load', (e2) => {
                // 正常終了
                let ele = document.getElementById("__drap__progress_msg").getElementsByTagName('progress')[0];
                ele.value = 100;
            });

            xhr.upload.addEventListener('loadend', (e2) => { 
                // アップロード終了 (エラー・正常終了両方)
            });

            xhr.onload = function(e){
                if(callback != null && callback != undefined){
                    callback(xhr.responseText);
                }else{
                    asyncUpload.close();
                }
            };
            xhr.send(fd);
        } else {
            asyncUpload.close();
        }
    },
    
};