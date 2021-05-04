<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>


<style>
    main#main {
        margin: 0rem;
    }

    audio {
        margin-top: 1rem;

    }


    #episodevisning {
        margin-top: 5.5rem;
        display: flex;
        /*        grid-template-rows: 1fr 1fr;*/
        padding-bottom: 1rem;
        flex-direction: column;

    }

    .tekst {
        padding: 2rem 2rem;
        background-color: #FFF8E6;
    }


    .billede {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }

    #episodergrid {
        margin-top: 2rem;
        display: grid;
        grid-template-columns: 1fr 4fr;
        grid-gap: 40px;
        padding-bottom: 2rem;
    }

    .streaming1,
    .streaming2,
    .streaming3 {
        width: 100%;
        padding-top: 2rem;
    }

    .streaming_grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        grid-gap: 15px;
    }

    .streaming1 {
        grid-column: 3/4;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }

    .streaming2 {
        grid-column: 4/5;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }

    .streaming3 {
        grid-column: 5/6;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }

    #episoder {
        margin: 1.5em;
    }


    h3 {
        padding-top: 1rem;
        font-weight: 600;
        font-size: 25px;
    }

    h2 {
        padding-top: 1rem;
        padding-bottom: 1.5rem;
        font-size: 29px;
    }

    h4 {
        font-weight: 600;
    }


    p {
        font-size: 13px;
    }

    .tilbage {
        font-weight: 300;
        color: #CA2D40;
    }

    .tilbage:hover {
        color: black;
    }



    @media (min-width: 700px) {


        button {
            margin-top: 3rem;
            padding: 1em 3rem;
        }

        #episodevisning {
            flex-direction: row;

        }

        .episodebillede {
            order: 2;
        }

        .image {
            grid-column: 1/2;
        }

        .info {
            grid-column: 2/3;
            padding-right: 3.5rem;
        }

        .tekst {
            padding: 2rem 2rem;
            background-color: #FFF8E6;
            width: 180vw;
        }


        .billede {
            height: 100%;
            width: 100%;
        }

        .epibillede {
            width: 60%;
            display: block;
            margin-right: auto;
            margin-left: auto;
        }

        .epibeskrivelse {
            font-size: 14px;
            padding-right: 4.5rem;

        }

        h2 {
            padding-top: 2rem;
            font-size: 2.6rem;
            color: black;
            font-weight: 500;
        }

        h3 {
            text-align: center;
        }

        audio {
            margin-top: 1rem;
            width: 70%;

        }

        h4 {
            font-size: 1rem;
            margin-top: 1.5rem;
            font-weight: 600;
        }

        p {
            line-height: 30px;
            font-size: 15px;
            color: black;
        }


        .streaming1,
        .streaming2,
        .streaming3 {
            width: 50%;
        }

        .et_fullwidth_nav #main-header .container {
            background-color: white;
        }

    }

</style>


<section id="primary" class="content-area">
    <main id="main" class="site-main">


        <article id="episodevisning">
            <div class="episodebillede">
                <img class="billede" src="" alt="">
            </div>
            <div class="tekst">
                <p></p>
                <a href="https://julielykkechristensen.dk/radioloud/podcasts/" class="tilbage">← TILBAGE TIL PODCASTS</a>
                <h2 class="navn">
                </h2>
                <p class="beskrivelse"></p>
                <div class="streaming_grid">
                    <img src="/radioloud/wp-content/themes/child/images/google.png" class="streaming1">
                    <img src="/radioloud/wp-content/themes/child/images/podimo.png" class="streaming2">
                    <img src="/radioloud/wp-content/themes/child/images/Apple_podcast.png" class="streaming3">
                </div>
            </div>
        </article>

        <section id="episoder">
            <h3>ALLE episoder</h3>
            <template>
                <article id="episodergrid">
                    <div class="image">
                        <img src="" class="epibillede" alt="">
                    </div>
                    <div class="info">
                        <h4 class="epinavn">
                        </h4>
                        <p class="epibeskrivelse"></p>
                        <!--                        <button class="afspil">AFSPIL</button>-->
                        <audio controls>
                            <source src="" id="lyd">
                        </audio>
                    </div>
                    <!--
                    <audio controls>
                        <source src="" id="lyd">
                    </audio>
-->
                </article>
            </template>
        </section>

        <!--        <audio src="https://api.spreaker.com/v2/episodes/42540723/play.mp3" id="lyd"></audio>-->

    </main>

    <script>
        let podcast;
        let episoder;
        let aktuelpodcast = <?php echo get_the_ID() ?>;

        const dbUrl = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/podcast/" + aktuelpodcast;
        const episodeUrl = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";

        const container = document.querySelector("#episoder");

        async function getJson() {
            const data = await fetch(dbUrl);
            podcast = await data.json();

            const data2 = await fetch(episodeUrl);
            episoder = await data2.json();
            console.log("episoder: ", episoder);

            visPodcast();
            visEpisoder();
        }

        function visPodcast() {
            console.log("hej med dig", podcast);
            document.querySelector(".navn").textContent = podcast.title.rendered;
            document.querySelector(".billede").src = podcast.billede.guid;
            document.querySelector(".beskrivelse").textContent = podcast.beskrivelse;
            //            document.querySelector("button").addEventListener("click", tilbageTilPodcasts);
        }

        function visEpisoder() {
            console.log("visEpisoder");
            let temp = document.querySelector("template");
            episoder.forEach(episode => {
                console.log("loop id :", aktuelpodcast);
                console.log("episode :", episode);
                if (episode.horer_til_podcast == aktuelpodcast) {
                    console.log("loop kører id :", aktuelpodcast);
                    let klon = temp.cloneNode(true).content;
                    klon.querySelector(".epinavn").innerHTML = episode.title.rendered;
                    klon.querySelector(".epibeskrivelse").innerHTML = episode.beskrivelse;
                    klon.querySelector(".epibillede").src = episode.billede.guid;
                    klon.querySelector("#lyd").src = episode.podcast_lyd;
                    //                    klon.querySelector(".afspil").addEventListener("click", spilPodcast)
                    container.appendChild(klon);
                }
            })
            //  spilPodcast();
        }

        function spilPodcast() {
            console.log("THIS PARENT ELEMENT", this.parentElement.parentElement);
            //    console.log("THIS", audio_object);
            this.parentElement.parentElement.querySelector("#lyd").play();
            // document.querySelector(".afspil").addEventListener("click", spilPodcast);
            // audio_object.play();
            // audio_object.volume = 1;
        }

        //        function tilbageTilPodcasts() {
        //            //history = webapi for at komme baglængs, hvis vi kalder back kommer vi et hak tilbage i browserhistorien (dermed tilbage til 01-kald.html)
        //            history.back();
        //
        //        }



        getJson();

    </script>

</section>

<?php
get_footer();
