<title>SoundLike - Configurações</title>

<main class="main-config">
    <div class="containerBtn">

<div class="divbtn">
    <button class="btn-config" id="btn">
        <img src="/img/Lua.png" class="lua-config">
        <p class="bolinha-config" id="bola"></p>
        <img src="/img/Sol.png" class="sol-config">
    </button>
</div>

<div class="divbtn">
    <button class="btn-config2" id="btn2">
        <img src="/img/Lua.png" class="lua-config">
        <p class="bolinha-config2" id="bola"></p>
        <img src="/img/Sol.png" class="sol-config">
    </button>
</div>

    </div>
</main>

<script>
    var bola = document.getElementById('bola')
    var btn = document.getElementById('btn')
    var btn2 = document.getElementById('btn2')
    
    btn.onclick = function mudarFundo() {
        if (document.body.style.backgroundColor = "#e9e9e9") {
            document.body.style.backgroundColor == "#161616"
            btn.style.zIndex = "1"
            btn2.style.zIndex = "2"
        }
    }
    btn2.onclick = function mudarFundo2() {
        if (document.body.style.backgroundColor = "#161616") {
            document.body.style.backgroundColor == "#e9e9e9"
            btn.style.zIndex = "2"
            btn2.style.zIndex = "1"
        }
    }
</script>

<style>
    .containerBtn{
        height: 140px;
        width: 260px;
    }
    .main-config{
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;

        height: 83vh;
    }
    .divbtn{
        position: absolute;
    }
    .btn-config, .btn-config2{
        display: flex;
        align-items: center;
        justify-content: space-around;
        position: relative;

        width: 260px;
        height: 140px;
        border-radius: 50rem;
        border: none;
        background-color: gray;
        cursor: pointer;
    }
    .btn-config{
        z-index: 2;
        background-color: black;
    }
    .btn-config2{
        z-index: 1;
    }
    .lua-config, .sol-config{
        height: 100px;
        width: 100px;
    }
    .bolinha-config{
        position: absolute;

        background: white;
        height: 120px;
        width: 120px;
        border-radius: 50rem;
        left: 0;
        margin: 0 10px;
    }
    .bolinha-config2{
        position: absolute;

        background: white;
        height: 120px;
        width: 120px;
        border-radius: 50rem;
        right: 0;
        margin: 0 10px;
    }
</style>