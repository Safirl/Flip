<section id="loading-screen" style="z-index:20;position: fixed; top:0; left:0; bottom:0; right:0;display:flex; justify-content: center;
    align-items: center;background: #CFFC00;transition: transform;transition-duration: 500ms">
    <img style="width: 100%;height: auto" src="{{ asset('images/covers/loading.gif') }}" alt=""/>
</section>
<script>
    const loadingScreen = document.getElementById("loading-screen");
    const loaded = sessionStorage.getItem("smash-loaded") === "true";

    if (loaded) {
        loadingScreen.style.display = "none";
    }
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            sessionStorage.setItem("smash-loaded", "true")
            loadingScreen.style.transform = "translate(-100%)";
        }, 1_500)
    })
</script>
