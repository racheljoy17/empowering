<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyB9zYvN-8PeqSa8qG_WLYc7VwiPSiUx6JE",
    authDomain: "empoweringhomes-f03b3.firebaseapp.com",
    databaseURL: "https://empoweringhomes-f03b3-default-rtdb.firebaseio.com",
    projectId: "empoweringhomes-f03b3",
    storageBucket: "empoweringhomes-f03b3.appspot.com",
    messagingSenderId: "488582206798",
    appId: "1:488582206798:web:877ff44decaa1b9713ba1f",
    measurementId: "G-XZ87LJN7YZ"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>