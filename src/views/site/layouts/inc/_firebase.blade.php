<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-messaging.js"></script>

<script>
     // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyBFTdSaanTuX7t4xLwmnVAYaj8F4YTAVek",
        authDomain: "egaby-dcd4a.firebaseapp.com",
        projectId: "egaby-dcd4a",
        storageBucket: "egaby-dcd4a.appspot.com",
        messagingSenderId: "612823761933",
        appId: "1:612823761933:web:474361af74f5da0c4dc144",
        measurementId: "G-85W6BPF89D"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //   firebase.analytics();
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token_
                    }
                });
                $.ajax({
                    url: _url_+"saveToken",
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log('Token stored.');
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            }).catch(function(error) {
                console.log(error);
            });
    }
    // @if (\Auth::check())
    //     startFCM();
    // @endif

    messaging.onMessage(function(payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        var notification = new Notification(title, options);

        var url = "{{ route('home') }}";

        if (payload.data.type == '' || payload.data.type == 'home') {
            url = url;
        } else{
            url = _url_ + payload.data.type;
        }
        notification.onclick = function() {
            window.open(url);
        };
    });
</script>