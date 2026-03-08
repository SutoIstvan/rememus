@extends('layouts.app')

@section('content')

  <main>
    <!-- =========================
    hero section
    ===========================-->
    <section class="relative bg-white dark:bg-background-8 z-0 sm:pb-0 pb-14 lg:-mb-12 md:-mb-10 overflow-hidden"
      id="scene">
      <!-- Video Background -->

      <figure class="absolute h-full w-full hero-bg-overlay-light dark:hero-bg-overlay-dark"></figure>
      <video
        class="w-full h-full absolute -top-[220px] left-0 scale-100 object-cover object-center z-[-1] min-h-[100vh] dark:hidden block"
        autoplay="" muted="" loop="" playsinline="">
        <source src="./video/Tube.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
      <video
        class="w-full h-full absolute -top-[220px] left-0 scale-100 object-cover object-center z-[-1] min-h-[100vh] hidden dark:block"
        autoplay="" muted="" loop="" playsinline="">
        <source src="./video/Tube-dark.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
      <div class="relative sm:pt-[280px] pt-[160px] pb-[100px] max-[641px]:pb-16 max-[426px]:pb-10 z-10">
        <!-- Background shape-->

        <!-- Hero images  -->
        <figure data-ns-animate data-delay="0.1"
          class="max-[426px]:size-10 shrink-0 w-[120px] h-[120px] sm:w-[150px] sm:h-[150px] md:w-[200px] md:h-[200px] rounded-full absolute left-[8%] top-[15%] md:left-[19%] md:top-[22%] xl:left-[36%] xl:top-[12%] -z-10 rounded-br-none p-[3px] parallax-effect"
          data-parallax-value="1.8" data-data-parallax-x="1" data-data-parallax-y="0.5">
          <img src="images/clouds/sun.png" alt="Hero shape 1" class="rounded-full max-[426px]:size-8" />
        </figure>
        <!-- <figure
            data-ns-animate
            data-delay="0.1"
            class="max-[426px]:size-10 shrink-0 w-[50px] h-[50px] rounded-full absolute right-[12%] top-[15%] md:right-[20%] md:top-[19%] xl:right-[24%] xl:top-[19%] -z-10 rounded-bl-none bg-white dark:bg-accent/20 p-[3px] parallax-effect"
            data-parallax-value="2.4"
            data-data-parallax-x="1"
            data-data-parallax-y="1"
            >
            <img
                src="images/home-page-2/hero-shape-2.png"
                alt="Hero shape 2"
                class="size-11 rounded-full max-[426px]:size-8"
            />
        </figure> -->
        <figure data-ns-animate data-delay="0.1"
          class="sm:block hidden max-[426px]:size-10 shrink-0 w-[150px] h-[50px] rounded-full absolute left-[7%] bottom-[16%] md:left-[8%] md:bottom-[18%] xl:left-[14%] xl:bottom-[18%] -z-10 rounded-br-none p-[3px] parallax-effect"
          data-parallax-value="1.8" data-data-parallax-x="0.7" data-data-parallax-y="-1">
          <img src="images/clouds/cloud-1.png" alt="Hero shape 3" class="max-[426px]:size-8" />
        </figure>
        <figure data-ns-animate data-delay="0.1"
          class="sm:block hidden max-[426px]:size-10 shrink-0 w-[150px] h-[50px] rounded-full absolute right-[10%] bottom-[15%] md:right-[25%] md:bottom-[15%] xl:right-[28%] xl:bottom-[15%] -z-10 rounded-bl-none p-[3px] parallax-effect"
          data-parallax-value="1.9" data-data-parallax-x="1" data-data-parallax-y="-0.7">
          <img src="images/clouds/cloud-2.png" alt="Hero shape 4" class="max-[426px]:size-8" />
        </figure>

        <!-- Static hero images (no parallax for better performance) -->
        <figure data-ns-animate data-delay="0.1"
          class="max-[426px]:size-10 shrink-0 w-[90px] h-[20px] rounded-full absolute left-[0%] bottom-[50%] md:left-[16%] md:bottom-[34%] xl:left-[23%] xl:bottom-[36%] -z-10 rounded-br-none p-[3px] parallax-effect"
          data-parallax-value="1.7" data-data-parallax-x="-0.8" data-data-parallax-y="1">
          <img src="images/clouds/cloud-1.png" alt="Hero shape 5" class="max-[426px]:size-8" />
        </figure>
        <figure data-ns-animate data-delay="0.1"
          class="max-[426px]:size-10 shrink-0 w-[200px] h-[80px] rounded-full absolute right-[0%] top-[40%] md:right-[5%] md:top-[30%] xl:right-[10%] xl:top-[32%] -z-10 rounded-bl-none p-[3px] parallax-effect"
          data-parallax-value="1.7" data-data-parallax-x="1" data-data-parallax-y="0.8">
          <img src="images/clouds/cloud-2.png" alt="Hero shape 6" class="max-[426px]:size-8" />
        </figure>
        <figure data-ns-animate data-delay="0.1"
          class="w-[150px] h-[50px] absolute right-[3%] md:right-[12%] bottom-[38%] md:bottom-[32%] xl:right-[14%] xl:bottom-[28%] -z-10 rounded-bl-none p-[3px] parallax-effect"
          data-parallax-value="1.7" data-data-parallax-x="-1" data-data-parallax-y="-1">
          <img src="images/clouds/cloud-1.png" alt="Hero shape 7" class="max-[426px]:size-8" />
        </figure>
        <figure data-ns-animate data-delay="0.1"
          class="sm:block hidden max-[226px]:size-10 shrink-0 w-[180px] h-[50px] absolute left-[0%] top-[32%] md:left-[3%] md:top-[42%] xl:left-[98%] xl:top-[42%] -z-10 rounded-br-none p-[3px] parallax-effect"
          data-parallax-value="1.7" data-data-parallax-x="0.5" data-data-parallax-y="-1">
          <img src="images/clouds/cloud-2.png" alt="Hero shape 8" class="w-full h-full object-contain" />
        </figure>
        <!-- Content -->
        <div class="main-container flex flex-col items-center text-center z-10">
            <span data-ns-animate data-delay="0.1" class="badge mb-5">
            <!-- Light theme -->
            <img
                src="images/clouds/qr-code.png"
                alt="remrmus qr-code"
                class="w-[100px] h-[100px] object-contain dark:hidden"
            />

            <!-- Dark theme -->
            <img
                src="images/clouds/qr-code-black.png"
                alt="remrmus qr-code dark"
                class="hidden w-[100px] h-[100px] object-contain dark:block"
            />
            </span>

          <h1 data-ns-animate data-delay="0.2"
            class="font-medium max-[426px]:mb-2.5 mb-4 max-[426px]:text-heading-5 max-sm:text-heading-4 max-sm:max-w-[450px]">
            We live on as long
            <br class="hidden md:block" />
            as we are remembered
          </h1>
          <p data-ns-animate data-delay="0.3" class="text-heading-6 max-w-[625px] mb-7 sm:mb-10 max-sm:max-w-[420px]">
            rememus.com ensures their story is never forgotten.
          </p>
          <ul class="flex flex-col md:flex-row gap-4 mb-7 md:mb-14 max-md:w-full">
            <li data-ns-animate data-delay="0.3" data-direction="left" data-offset="50">
              <a href="./login-page-01.html"
                class="btn max-md:btn-md w-full md:w-auto max-md:mx-auto btn-xl dark:btn-accent btn-secondary hover:btn-white dark:hover:btn-transparent">
                <span>Buy now</span>
              </a>
            </li>
            <li data-ns-animate data-delay="0.5" data-direction="left" data-offset="50">
              <a href="./pricing-page-01.html"
                class="btn btn-white max-md:btn-md w-full md:w-auto max-md:mx-auto btn-xl hover:btn-secondary dark:btn-transparent dark:hover:btn-accent">
                <span>Free</span>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div data-ns-animate data-delay="0.2" data-offset="10">
        <div class="flex gap-4 justify-center items-center overflow-y-auto overflow-x-hidden scroll-bar">
          <figure class="rounded-[20px] overflow-hidden max-h-[380px] min-w-[257px] w-full ml-4">
            <img src="rememus-11.png" class="w-full h-full object-cover" alt="hero-slide-1" />
          </figure>
          <figure class="rounded-[20px] overflow-hidden max-h-[380px] min-w-[257px] w-full">
            <img src="rememus-10.png" class="w-full h-full object-cover" alt="hero-slide-2" />
          </figure>
          <figure class="rounded-[20px] overflow-hidden max-h-[380px] min-w-[257px] w-full">
            <img src="rememus-12.png" class="w-full h-full object-cover" alt="hero-slide-3" />
          </figure>
          <figure class="scroll-expand rounded-[20px] overflow-hidden max-h-[380px] min-w-[500px] w-full">
            <video class="w-full h-full object-cover" style="height: 380px;" autoplay muted loop playsinline>
              <source src="header-bg.mp4" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
          </figure>
          <figure class="rounded-[20px] overflow-hidden max-h-[380px] min-w-[257px] w-full">
            <img src="rememus-8.png" class="w-full h-full object-cover" alt="hero-slide-5" />
          </figure>
          <figure class="rounded-[20px] overflow-hidden max-h-[380px] min-w-[257px] w-full">
            <img src="rememus-3.png" class="w-full h-full object-cover" alt="hero-slide-6" />
          </figure>
          <figure class="rounded-[20px] overflow-hidden max-h-[380px] min-w-[257px] w-full">
            <img src="rememus-2.png" class="w-full h-full object-cover" alt="hero-slide-7" />
          </figure>
        </div>
      </div>

        <!-- <div
            data-ns-animate
            data-delay="0.7"
            data-instant="true"
            class="relative max-w-[1290px] mx-auto lp:mx-auto max-lp:mx-5 max-sm:rounded-2xl rounded-4xl overflow-hidden max-sm:p-2 p-2.5 bg-background-3 dark:bg-background-7 max-sm:max-w-[450px] max-sm:mx-auto max-[500px]:!mx-5"
                >
                    <video
                        class="w-full h-full object-cover max-sm:rounded-xl rounded-[25px]"
                        autoplay
                        muted
                        loop
                        playsinline
                    >
                        <source src="header-bg.mp4" type="video/mp4" />
                        Your browser does not support the video tag.
                    </video>
        </div> -->
    </section>



    <!-- =========================
    Services section
    ===========================-->
    <section class="bg-white dark:bg-background-6 pb-[50px] xl:pb-[100px] pt-[50px] md:pt-[85px] xl:pt-[100px]">
      <div class="main-container">
        <div class="space-y-[40px] md:space-y-[50px] lg:space-y-[60px] xl:space-y-[70px]">
          <!-- service section heading  -->
          <div class="max-w-[810px] text-center lg:w-full mx-auto space-y-5">
            <span data-ns-animate data-delay="0.1" class="badge badge-green mb-3 md:mb-4 lg:mb-5">
              Simple steps
            </span>

            <div class="space-y-3">
              <h2 data-ns-animate data-delay="0.2">
                Bring Their Story To Life
              </h2>
              <p data-ns-animate data-delay="0.3" class="max-w-[582px] mx-auto sm:w-full">
                To create a memorial page, you only need to take a few simple steps.
              </p>
            </div>
          </div>

          <!-- service cards  -->
          <div class="flex items-center justify-center flex-wrap gap-8">
            <!-- service card 01  -->
            <article data-ns-animate data-delay="0.4">
              <div
                class="max-w-[403px] w-full py-8 px-6 bg-background-2 dark:bg-background-5 rounded-[20px] flex flex-col items-center gap-6 hover:translate-y-[-10px] transition-transform duration-500 ease-in-out">
                <!-- logo  -->
                <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" viewBox="0 0 24 24" fill="none">
                  <path
                    d="M2 16.9C2 15.5906 2 14.9359 2.29472 14.455C2.45963 14.1859 2.68589 13.9596 2.955 13.7947C3.43594 13.5 4.09063 13.5 5.4 13.5H6.5C8.38562 13.5 9.32843 13.5 9.91421 14.0858C10.5 14.6716 10.5 15.6144 10.5 17.5V18.6C10.5 19.9094 10.5 20.5641 10.2053 21.045C10.0404 21.3141 9.81411 21.5404 9.545 21.7053C9.06406 22 8.40937 22 7.1 22C5.13594 22 4.15391 22 3.4325 21.5579C3.02884 21.3106 2.68945 20.9712 2.44208 20.5675C2 19.8461 2 18.8641 2 16.9Z"
                    stroke="#3f3f42" stroke-width="1.5" />
                  <path
                    d="M13.5 5.4C13.5 4.09063 13.5 3.43594 13.7947 2.955C13.9596 2.68589 14.1859 2.45963 14.455 2.29472C14.9359 2 15.5906 2 16.9 2C18.8641 2 19.8461 2 20.5675 2.44208C20.9712 2.68945 21.3106 3.02884 21.5579 3.4325C22 4.15391 22 5.13594 22 7.1C22 8.40937 22 9.06406 21.7053 9.545C21.5404 9.81411 21.3141 10.0404 21.045 10.2053C20.5641 10.5 19.9094 10.5 18.6 10.5H17.5C15.6144 10.5 14.6716 10.5 14.0858 9.91421C13.5 9.32843 13.5 8.38562 13.5 6.5V5.4Z"
                    stroke="#3f3f42" stroke-width="1.5" />
                  <path
                    d="M16.5 6.25C16.5 5.73459 16.5 5.47689 16.6291 5.29493C16.6747 5.23072 16.7307 5.17466 16.7949 5.12911C16.9769 5 17.2346 5 17.75 5C18.2654 5 18.5231 5 18.7051 5.12911C18.7693 5.17466 18.8253 5.23072 18.8709 5.29493C19 5.47689 19 5.73459 19 6.25C19 6.76541 19 7.02311 18.8709 7.20507C18.8253 7.26928 18.7693 7.32534 18.7051 7.37089C18.5231 7.5 18.2654 7.5 17.75 7.5C17.2346 7.5 16.9769 7.5 16.7949 7.37089C16.7307 7.32534 16.6747 7.26928 16.6291 7.20507C16.5 7.02311 16.5 6.76541 16.5 6.25Z"
                    fill="#3f3f42" />
                  <path
                    d="M12.75 22C12.75 22.4142 13.0858 22.75 13.5 22.75C13.9142 22.75 14.25 22.4142 14.25 22H12.75ZM14.3889 13.8371L14.8055 14.4607L14.8055 14.4607L14.3889 13.8371ZM13.8371 14.3889L13.2135 13.9722L13.2135 13.9722L13.8371 14.3889ZM19 12.75H17V14.25H19V12.75ZM12.75 19V22H14.25V19H12.75ZM17 12.75C16.3134 12.75 15.742 12.7491 15.281 12.796C14.8075 12.8441 14.3682 12.9489 13.9722 13.2135L14.8055 14.4607C14.914 14.3882 15.078 14.3244 15.4328 14.2883C15.8002 14.2509 16.2822 14.25 17 14.25V12.75ZM14.25 17C14.25 16.2822 14.2509 15.8002 14.2883 15.4328C14.3244 15.078 14.3882 14.914 14.4607 14.8055L13.2135 13.9722C12.9489 14.3682 12.8441 14.8075 12.796 15.281C12.7491 15.742 12.75 16.3134 12.75 17H14.25ZM13.9722 13.2135C13.6719 13.4141 13.4141 13.6719 13.2135 13.9722L14.4607 14.8055C14.5519 14.669 14.669 14.5519 14.8055 14.4607L13.9722 13.2135Z"
                    fill="#3f3f42" />
                  <path
                    d="M22.75 13.5C22.75 13.0858 22.4142 12.75 22 12.75C21.5858 12.75 21.25 13.0858 21.25 13.5H22.75ZM20.7654 21.8478L21.0524 22.5407L21.0524 22.5407L20.7654 21.8478ZM21.8478 20.7654L21.1548 20.4784V20.4784L21.8478 20.7654ZM17 22.75H19V21.25H17V22.75ZM22.75 17V13.5H21.25V17H22.75ZM19 22.75C19.4557 22.75 19.835 22.7504 20.1454 22.7292C20.4625 22.7076 20.762 22.661 21.0524 22.5407L20.4784 21.1548C20.4012 21.1868 20.284 21.2163 20.0433 21.2327C19.7958 21.2496 19.4762 21.25 19 21.25V22.75ZM21.25 19C21.25 19.4762 21.2496 19.7958 21.2327 20.0433C21.2163 20.284 21.1868 20.4012 21.1548 20.4784L22.5407 21.0524C22.661 20.762 22.7076 20.4625 22.7292 20.1454C22.7504 19.835 22.75 19.4557 22.75 19H21.25ZM21.0524 22.5407C21.7262 22.2616 22.2616 21.7262 22.5407 21.0524L21.1548 20.4784C21.028 20.7846 20.7846 21.028 20.4784 21.1549L21.0524 22.5407Z"
                    fill="#3f3f42" />
                  <path
                    d="M2 7.1C2 5.13594 2 4.15391 2.44208 3.4325C2.68945 3.02884 3.02884 2.68945 3.4325 2.44208C4.15391 2 5.13594 2 7.1 2C8.40937 2 9.06406 2 9.545 2.29472C9.81411 2.45963 10.0404 2.68589 10.2053 2.955C10.5 3.43594 10.5 4.09063 10.5 5.4V6.5C10.5 8.38562 10.5 9.32843 9.91421 9.91421C9.32843 10.5 8.38562 10.5 6.5 10.5H5.4C4.09063 10.5 3.43594 10.5 2.955 10.2053C2.68589 10.0404 2.45963 9.81411 2.29472 9.545C2 9.06406 2 8.40937 2 7.1Z"
                    stroke="#3f3f42" stroke-width="1.5" />
                  <path
                    d="M5 6.25C5 5.73459 5 5.47689 5.12911 5.29493C5.17466 5.23072 5.23072 5.17466 5.29493 5.12911C5.47689 5 5.73459 5 6.25 5C6.76541 5 7.02311 5 7.20507 5.12911C7.26928 5.17466 7.32534 5.23072 7.37089 5.29493C7.5 5.47689 7.5 5.73459 7.5 6.25C7.5 6.76541 7.5 7.02311 7.37089 7.20507C7.32534 7.26928 7.26928 7.32534 7.20507 7.37089C7.02311 7.5 6.76541 7.5 6.25 7.5C5.73459 7.5 5.47689 7.5 5.29493 7.37089C5.23072 7.32534 5.17466 7.26928 5.12911 7.20507C5 7.02311 5 6.76541 5 6.25Z"
                    fill="#3f3f42" />
                  <path
                    d="M5 17.75C5 17.2346 5 16.9769 5.12911 16.7949C5.17466 16.7307 5.23072 16.6747 5.29493 16.6291C5.47689 16.5 5.73459 16.5 6.25 16.5C6.76541 16.5 7.02311 16.5 7.20507 16.6291C7.26928 16.6747 7.32534 16.7307 7.37089 16.7949C7.5 16.9769 7.5 17.2346 7.5 17.75C7.5 18.2654 7.5 18.5231 7.37089 18.7051C7.32534 18.7693 7.26928 18.8253 7.20507 18.8709C7.02311 19 6.76541 19 6.25 19C5.73459 19 5.47689 19 5.29493 18.8709C5.23072 18.8253 5.17466 18.7693 5.12911 18.7051C5 18.5231 5 18.2654 5 17.75Z"
                    fill="#3f3f42" />
                  <path
                    d="M16 17.75C16 17.0478 16 16.6967 16.1685 16.4444C16.2415 16.3352 16.3352 16.2415 16.4444 16.1685C16.6967 16 17.0478 16 17.75 16C18.4522 16 18.8033 16 19.0556 16.1685C19.1648 16.2415 19.2585 16.3352 19.3315 16.4444C19.5 16.6967 19.5 17.0478 19.5 17.75C19.5 18.4522 19.5 18.8033 19.3315 19.0556C19.2585 19.1648 19.1648 19.2585 19.0556 19.3315C18.8033 19.5 18.4522 19.5 17.75 19.5C17.0478 19.5 16.6967 19.5 16.4444 19.3315C16.3352 19.2585 16.2415 19.1648 16.1685 19.0556C16 18.8033 16 18.4522 16 17.75Z"
                    fill="#3f3f42" />
                </svg>
                <!-- heading  -->
                <div class="text-center space-y-2">
                  <h3 class="text-heading-5">Scan the QR code</h3>
                  <p>Gain deep insights into your contacts at a glance and easily track</p>
                </div>

                <!-- btn  -->
                <div>
                  <a href="./our-services-details-page.html"
                    class="btn btn-md btn-white-v2 hover:btn-secondary dark:btn-transparent dark:hover:btn-accent"
                    rel="noopener noreferrer">
                    <span>Read more</span>
                  </a>
                </div>
              </div>
            </article>

            <!-- service card 02  -->
            <article data-ns-animate data-delay="0.5">
              <div
                class="max-w-[403px] w-full py-8 px-6 bg-background-2 dark:bg-background-5 rounded-[20px] flex flex-col items-center gap-6 hover:translate-y-[-10px] transition-transform duration-500 ease-in-out">
                <!-- logo  -->
                <span class="h-[54px] text-secondary dark:text-accent">

                  <svg xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" fill="none">
                    <path
                      d="M8.25 15.5C8.25 15.9142 8.58579 16.25 9 16.25C9.41421 16.25 9.75 15.9142 9.75 15.5H8.25ZM11.6643 8.75249L12.1624 8.19186L12.1624 8.19186L11.6643 8.75249ZM11.25 10.425C11.25 10.8392 11.5858 11.175 12 11.175C12.4142 11.175 12.75 10.8392 12.75 10.425H11.25ZM11.7475 8.83575L12.3081 8.33756L12.3081 8.33756L11.7475 8.83575ZM6.33575 8.75249L5.83756 8.19186L5.83756 8.19186L6.33575 8.75249ZM5.25 10.425C5.25 10.8392 5.58579 11.175 6 11.175C6.41421 11.175 6.75 10.8392 6.75 10.425H5.25ZM6.25249 8.83575L5.69186 8.33756L5.69186 8.33756L6.25249 8.83575ZM7 14.75C6.58579 14.75 6.25 15.0858 6.25 15.5C6.25 15.9142 6.58579 16.25 7 16.25V14.75ZM11 16.25C11.4142 16.25 11.75 15.9142 11.75 15.5C11.75 15.0858 11.4142 14.75 11 14.75V16.25ZM7.925 9.25H9V7.75H7.925V9.25ZM9 9.25H10.075V7.75H9V9.25ZM9.75 15.5V8.5H8.25V15.5H9.75ZM10.075 9.25C10.5295 9.25 10.8007 9.25137 10.9965 9.27579C11.1739 9.29792 11.1831 9.3283 11.1661 9.31312L12.1624 8.19186C11.8612 7.92419 11.5109 7.82832 11.1822 7.78733C10.8719 7.74863 10.4905 7.75 10.075 7.75V9.25ZM12.75 10.425C12.75 10.0095 12.7514 9.62806 12.7127 9.31782C12.6717 8.98915 12.5758 8.63878 12.3081 8.33756L11.1869 9.33394C11.1717 9.31686 11.2021 9.32608 11.2242 9.50348C11.2486 9.69931 11.25 9.97047 11.25 10.425H12.75ZM11.1661 9.31312C11.1734 9.31964 11.1804 9.32659 11.1869 9.33394L12.3081 8.33756C12.2625 8.28617 12.2138 8.23752 12.1624 8.19186L11.1661 9.31312ZM7.925 7.75C7.50946 7.75 7.12806 7.74863 6.81782 7.78733C6.48914 7.82832 6.13878 7.92419 5.83756 8.19186L6.83394 9.31312C6.81686 9.3283 6.82608 9.29792 7.00348 9.27579C7.19931 9.25137 7.47047 9.25 7.925 9.25V7.75ZM6.75 10.425C6.75 9.97047 6.75137 9.69931 6.77579 9.50348C6.79792 9.32608 6.8283 9.31686 6.81312 9.33394L5.69186 8.33756C5.42419 8.63878 5.32832 8.98915 5.28733 9.31782C5.24863 9.62806 5.25 10.0095 5.25 10.425H6.75ZM5.83756 8.19186C5.78617 8.23752 5.73752 8.28617 5.69186 8.33756L6.81312 9.33394C6.81965 9.3266 6.8266 9.31965 6.83394 9.31312L5.83756 8.19186ZM7 16.25H11V14.75H7V16.25Z"
                      fill="#3f3f42" />
                    <path
                      d="M12 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H12M15 4.00093C18.1143 4.01004 19.7653 4.10848 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.7653 19.8915 18.1143 19.99 15 19.9991"
                      stroke="#3f3f42" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M15 2V22" stroke="#3f3f42" stroke-width="1.5" stroke-linecap="round" />
                  </svg>


                </span>

                <!-- heading  -->
                <div class="text-center space-y-2">
                  <h3 class="text-heading-5">Enter basic details</h3>
                  <p>Gain deep insights into your contacts at a glance and easily track</p>
                </div>

                <!-- btn  -->
                <div>
                  <a href="./our-services-details-page.html"
                    class="btn btn-md btn-white-v2 hover:btn-secondary dark:btn-transparent dark:hover:btn-accent"
                    rel="noopener noreferrer">
                    <span>Read more</span>
                  </a>
                </div>
              </div>
            </article>

            <!-- service card 03  -->
            <article data-ns-animate data-delay="0.6">
              <div
                class="max-w-[403px] w-full py-8 px-6 bg-background-2 dark:bg-background-5 rounded-[20px] flex flex-col items-center gap-6 hover:translate-y-[-10px] transition-transform duration-500 ease-in-out">
                <!-- logo  -->
                <svg xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" fill="none">
                  <path
                    d="M4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C6.55332 19.8124 4 14.6055 4 10.1433Z"
                    stroke="#3f3f42" stroke-width="1.5" />
                  <circle cx="12" cy="10" r="4" stroke="#3f3f42" stroke-width="1.5" />
                  <path d="M10.5 10H13.5" stroke="#3f3f42" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M12 11.5L12 8.5" stroke="#3f3f42" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <!-- heading  -->
                <div class="text-center space-y-2">
                  <h3 class="text-heading-5">Attach the QR code</h3>
                  <p>Gain deep insights into your contacts at a glance and easily track</p>
                </div>

                <!-- btn  -->
                <div>
                  <a href="./our-services-details-page.html"
                    class="btn btn-md btn-white-v2 hover:btn-secondary dark:btn-transparent dark:hover:btn-accent"
                    rel="noopener noreferrer">
                    <span>Read more</span>
                  </a>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>



    <!-- =========================
    Feature v2 section
    ===========================-->
    <section class="pt-[100px] pb-14 md:pb-16 lg:pb-[88px] xl:pb-[100px] bg-background-3 dark:bg-background-6">
      <div class="main-container">
        <div class="grid grid-cols-12 md:gap-y-18 lg:gap-x-[60px] xl:gap-x-[100px] items-center">
          <div class="col-span-12 lg:col-span-7 max-md:mb-18">
            <div>
              <div class="relative max-w-[300px] md:max-w-[400px] lg:max-w-[500px] md:ms-16 lg:ms-0 w-full">
                <figure data-ns-animate data-delay="0.8" data-duration="1.7" data-spring
                  class="absolute top-[12%] md:top-[20%] lg:top-[17%] xl:top-[20%] -right-[20px] md:-right-[130px] lg:-right-[15px] xl:-right-[130px] w-[100px]">
                  <img src="images/home-page-16/cursor.svg" alt="Box contents" class="w-full h-full dark:hidden" />
                  <img src="images/home-page-16/cursor-dark.svg" alt="Box contents"
                    class="w-full h-full hidden dark:block" />
                </figure>
                <!-- <figure
              data-ns-animate
              data-delay="0.9"
              data-duration="2.4"
              data-spring
              class="absolute top-[40%] md:top-[32%] left-[60%] md:left-[82%] lg:left-[63%] xl:left-[82%] max-w-[140px] md:max-w-[208px] lg:max-w-[200px] xl:max-w-[253px] w-full z-10 rounded-[20px] overflow-hidden rotate-[8deg]"
            >
              <img
                src="images/home-page-16/transaction-chart.png"
                alt="features"
                class="w-full h-full dark:hidden"
              />
              <img
                src="images/home-page-16/transaction-chart-dark.png"
                alt="features"
                class="w-full h-full hidden dark:block"
              />
            </figure> -->

                <!-- <figure
              data-ns-animate
              data-delay="0.7"
              class="w-full md:max-w-[500px] lg:max-w-[400px] xl:max-w-[500px]"
            >
              <img
                src="images/home-page-16/feature-image-1.png"
                alt="features"
                class="w-full dark:hidden"
              />
              <img
                src="images/home-page-16/feature-image-1-dark.png"
                alt="features"
                class="w-full hidden dark:block"
              />
            </figure> -->

                <figure data-ns-animate data-delay="0.7"
                  class="w-full md:max-w-[500px] lg:max-w-[400px] xl:max-w-[500px]">
                  <!-- Светлая тема: видео -->
                  <video class="w-full dark:hidden rounded-[20px]" autoplay muted playsinline>
                    <source src="RemBoxVideo.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>

                  <!-- Тёмная тема: видео -->
                  <video class="w-full hidden dark:block rounded-[20px]" autoplay muted playsinline>
                    <source src="RemBoxVideo.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </figure>


                <figure data-ns-animate data-delay="2.9" data-duration="2.7" data-spring
                  class="absolute bottom-0 md:bottom-1/12 left-[40%] md:left-[82%] max-w-[200px] md:max-w-[265px] lg:max-w-[250px] xl:max-w-[333px] w-full rounded-[10px] overflow-hidden">
                  <img src="silver-1.png" alt="features" class="max-w-[220px] dark:hidden" />
                  <img src="black-1.png" alt="features" class="max-w-[220px] hidden dark:block" />
                </figure>
              </div>
            </div>
          </div>
          <div class="col-span-12 lg:col-span-5">
            <div class="space-y-8">
              <div class="space-y-5">
                <span data-ns-animate data-delay="0.2" class="badge badge-green">
                  Box contents
                </span>
                <div class="space-y-3">
                  <h2 data-ns-animate data-delay="0.3">
                    What’s inside the Rememus box:
                  </h2>
                </div>
              </div>
              <div>
                <ul class="space-y-2">
                  <li data-ns-animate data-delay="0.4" class="p-2 flex items-center gap-4">
                    <span class="ns-shape-12 text-[36px] text-secondary dark:text-accent"></span>
                    <span class="text-tagline-1 font-medium text-secondary dark:text-accent">
                      Plate — black or gray
                    </span>
                  </li>
                  <li data-ns-animate data-delay="0.5" class="p-2 flex items-center gap-4">
                    <span class="text-[36px] text-secondary dark:text-accent">

                      <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="43px" viewBox="0 0 48 48">
                        <defs>
                          <style>
                            .a {
                              fill: none;
                              stroke: #000000;
                              stroke-linecap: round;
                              stroke-linejoin: round;
                            }
                          </style>
                        </defs>
                        <path class="a"
                          d="M12.1488,23.7163c-1.4374-11.3452,12.9724-12.405,14.5748-2.0282,3.4891-2.662,7.874.2786,7.05,4.9164,8.2277.0745,7.03,9.6783,2.2263,9.9257H10.0262c-7.0183.1741-8.4183-12.3937,2.1226-12.8139l-.2673-.173" />
                        <path class="a" d="M24.1,16.0075A10.6678,10.6678,0,1,1,39.7363,30.2681" />
                      </svg>

                    </span>
                    <span class="text-tagline-1 font-medium text-secondary dark:text-accent">
                      3M weather-resistant adhesive
                    </span>
                  </li>
                  <li data-ns-animate data-delay="0.6" class="p-2 flex items-center gap-4">
                    <span class="ns-shape-47 text-[36px] text-secondary dark:text-accent"></span>
                    <span class="text-tagline-1 font-medium text-secondary dark:text-accent">
                      Cleaning wipe
                    </span>
                  </li>
                  <li data-ns-animate data-delay="0.7" class="p-2 flex items-center gap-4">
                    <span class="text-[36px] text-secondary dark:text-accent">
                      <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px" viewBox="0 0 48 48">
                        <defs>
                          <style>
                            .a {
                              fill: none;
                              stroke: #000000;
                              stroke-linecap: round;
                              stroke-linejoin: round;
                            }
                          </style>
                        </defs>
                        <path class="a"
                          d="M10.3635,4.51A1.9944,1.9944,0,0,0,8.4189,6.5043V41.5056A1.9945,1.9945,0,0,0,10.3635,43.5H37.5867a1.9944,1.9944,0,0,0,1.9944-1.9944V14.4719H31.6036a1.9945,1.9945,0,0,1-1.9446-1.9944V4.5Z" />
                        <line class="a" x1="29.5693" y1="4.51" x2="39.5312" y2="14.4719" />
                        <line class="a" x1="15.838" y1="22.928" x2="32.1121" y2="22.928" />
                        <line class="a" x1="15.838" y1="34.994" x2="32.1121" y2="34.994" />
                        <line class="a" x1="15.838" y1="28.961" x2="32.1121" y2="28.961" />
                      </svg>
                    </span>
                    <span class="text-tagline-1 font-medium text-secondary dark:text-accent">
                      Instruction manual
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- =========================
Feature section
===========================-->
    <!-- <section
  class="relative py-14 max-[426px]:py-10 md:py-16 lg:py-[88px] xl:py-[100px] bg-white dark:bg-background-6 overflow-hidden"
>
  <div class="main-container">
    <div class="flex items-center flex-wrap lg:flex-nowrap gap-8 lg:gap-4 xl:gap-8">
      <div class="w-full lg:w-2/5">
        <div class="mb-8 max-[426px]:mb-5 space-y-5 text-center sm:text-left max-[426px]:text-left">
          <span data-ns-animate data-delay="0.1" class="badge badge-yellow"> Feature </span>
          <h2 data-ns-animate data-delay="0.2">
            Streamline your <br class="hidden lg:block" />
            business operations.
          </h2>
        </div>

        <ul class="list-none space-y-4 mb-14 max-[426px]:mb-10">
          <li data-ns-animate data-delay="0.3" class="flex items-center gap-2">
            <svg
              width="18"
              height="18"
              viewBox="0 0 18 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect width="18" height="18" rx="9" fill="" class="fill-secondary dark:fill-white" />
              <path
                d="M8.31661 12.7561L13.7491 7.42144C14.0836 7.0959 14.0836 6.5697 13.7491 6.24416C13.4145 5.91861 12.8736 5.91861 12.539 6.24416L7.7116 10.9901L5.46096 8.78807C5.12636 8.46253 4.58554 8.46253 4.25095 8.78807C3.91635 9.11362 3.91635 9.63982 4.25095 9.96536L7.1066 12.7561C7.27347 12.9184 7.49253 13 7.7116 13C7.93067 13 8.14974 12.9184 8.31661 12.7561Z"
                fill=""
                class="fill-white dark:fill-secondary"
              />
            </svg>

            <span class="text-secondary dark:text-accent"
              >Add a feature section about the product.</span
            >
          </li>
          <li data-ns-animate data-delay="0.4" class="flex items-center gap-2">
            <svg
              width="18"
              height="18"
              viewBox="0 0 18 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect width="18" height="18" rx="9" fill="" class="fill-secondary dark:fill-white" />
              <path
                d="M8.31661 12.7561L13.7491 7.42144C14.0836 7.0959 14.0836 6.5697 13.7491 6.24416C13.4145 5.91861 12.8736 5.91861 12.539 6.24416L7.7116 10.9901L5.46096 8.78807C5.12636 8.46253 4.58554 8.46253 4.25095 8.78807C3.91635 9.11362 3.91635 9.63982 4.25095 9.96536L7.1066 12.7561C7.27347 12.9184 7.49253 13 7.7116 13C7.93067 13 8.14974 12.9184 8.31661 12.7561Z"
                fill=""
                class="fill-white dark:fill-secondary"
              />
            </svg>

            <span class="text-secondary dark:text-accent"
              >Add a feature section about the product.</span
            >
          </li>
          <li data-ns-animate data-delay="0.5" class="flex items-center gap-2">
            <svg
              width="18"
              height="18"
              viewBox="0 0 18 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect width="18" height="18" rx="9" fill="" class="fill-secondary dark:fill-white" />
              <path
                d="M8.31661 12.7561L13.7491 7.42144C14.0836 7.0959 14.0836 6.5697 13.7491 6.24416C13.4145 5.91861 12.8736 5.91861 12.539 6.24416L7.7116 10.9901L5.46096 8.78807C5.12636 8.46253 4.58554 8.46253 4.25095 8.78807C3.91635 9.11362 3.91635 9.63982 4.25095 9.96536L7.1066 12.7561C7.27347 12.9184 7.49253 13 7.7116 13C7.93067 13 8.14974 12.9184 8.31661 12.7561Z"
                fill=""
                class="fill-white dark:fill-secondary"
              />
            </svg>

            <span class="text-secondary dark:text-accent">Single upfront payment.</span>
          </li>
        </ul>
        <div data-ns-animate data-delay="0.6">
          <a
            href="./features-page-01.html"
            class="btn btn-white btn-lg sm:btn-xl dark:btn-transparent hover:btn-secondary dark:hover:btn-accent w-full sm:w-auto"
          >
            <span>Get started</span>
          </a>
        </div>
      </div>

      <div
        class="w-full lg:w-3/5 rounded-[20px] bg-background-2 dark:bg-background-5 p-5 md:p-8 xl:p-[50px] max-[426px]:rounded-2xl"
      >
        <div class="flex gap-4 sm:gap-2.5 flex-wrap sm:flex-nowrap">
          <div
            data-ns-animate
            data-delay="0.3"
            data-direction="up"
            class="bg-white dark:bg-background-6 p-6 max-[426px]:p-5 rounded-2xl w-full sm:w-3/5 max-[426px]:rounded-xl"
          >
            <h5 class="mb-4 max-[426px]:text-heading-6">
              Task <br class="hidden lg:block" />
              management
            </h5>
            <div class="flex items-center gap-4 mb-7">
              <figure
                class="inline-block size-14 max-[426px]:size-10 rounded-full ring-4 ring-white bg-linear-[135deg,#ffffff_0%,#a585ff_100%] overflow-hidden relative"
              >
                <img src="images/avatar/avatar-7.png" alt="avatar" class="max-w-full" />
                <img
                  src="images/avatar/author-avatar-bg.png"
                  alt="avatar"
                  class="absolute top-0 left-0 -z-10"
                />
              </figure>
              <div>
                <h5 class="max-[426px]:text-tagline-1">Curious george</h5>
                <p class="max-[426px]:text-tagline-2">UI UX designer</p>
              </div>
            </div>
            <div
              class="w-full h-[1px] bg-secondary/10 dark:bg-accent/10 mb-7 max-[426px]:mb-4"
            ></div>
            <div class="flex items-center justify-between sm:mb-5">
              <p class="text-tagline-2 font-medium">1 days Ago</p>
              <svg
                width="18"
                height="16"
                viewBox="0 0 18 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.34462 13.401L13.2849 15.8974C13.7886 16.2165 14.4139 15.7419 14.2644 15.154L13.126 10.6756C13.0939 10.5509 13.0977 10.4197 13.137 10.297C13.1762 10.1743 13.2492 10.0652 13.3477 9.98222L16.8811 7.04132C17.3453 6.6549 17.1057 5.88439 16.5092 5.84567L11.8949 5.5462C11.7706 5.53732 11.6514 5.49332 11.5511 5.41931C11.4509 5.34531 11.3737 5.24435 11.3286 5.12819L9.60765 0.794357C9.56087 0.671064 9.47769 0.564919 9.36915 0.490017C9.26062 0.415115 9.13187 0.375 9 0.375C8.86813 0.375 8.73938 0.415115 8.63085 0.490017C8.52232 0.564919 8.43914 0.671064 8.39236 0.794357L6.6714 5.12819C6.6263 5.24435 6.54914 5.34531 6.4489 5.41931C6.34865 5.49332 6.22944 5.53732 6.10515 5.5462L1.49078 5.84567C0.894294 5.88439 0.654664 6.6549 1.11894 7.04132L4.65232 9.98222C4.75079 10.0652 4.82383 10.1743 4.86305 10.297C4.90226 10.4197 4.90606 10.5509 4.874 10.6756L3.81824 14.8288C3.63889 15.5343 4.38929 16.1038 4.99369 15.7209L8.65539 13.401C8.75837 13.3354 8.87792 13.3006 9 13.3006C9.12208 13.3006 9.24163 13.3354 9.34462 13.401Z"
                  fill=""
                  class="fill-secondary dark:fill-accent"
                />
              </svg>
            </div>
          </div>

          <div
            data-ns-animate
            data-delay="0.3"
            class="bg-white dark:bg-background-6 p-6 rounded-2xl w-full sm:w-2/5"
          >
            <h5 class="mb-4 max-[426px]:text-heading-6">Progress Tracking</h5>
            <div class="relative w-fit flex items-center justify-center">
              <svg
                class="size-[176px] max-[426px]:size-32"
                viewBox="0 0 176 176"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M15.4106 38.2529C5.02285 53.4103 -0.359462 71.4393 0.0186306 89.8107C0.396723 108.182 6.51625 125.974 17.5188 140.692C28.5213 155.409 43.8549 166.313 61.3685 171.874C78.8822 177.434 97.6973 177.373 115.175 171.699C132.652 166.025 147.914 155.022 158.821 140.234C169.728 125.445 175.732 107.614 175.991 89.2404C176.25 70.8669 170.751 52.8732 160.265 37.7834C149.78 22.6937 134.833 11.2648 117.523 5.10011L116.189 8.84623C132.717 14.7324 146.988 25.6448 157 40.0526C167.012 54.4605 172.262 71.6411 172.015 89.1843C171.768 106.728 166.035 123.753 155.621 137.873C145.207 151.993 130.634 162.499 113.947 167.917C97.2591 173.335 79.2942 173.393 62.572 168.083C45.8497 162.774 31.2091 152.363 20.7037 138.31C10.1984 124.258 4.35538 107.27 3.99437 89.7289C3.63337 72.1876 8.77246 54.9734 18.6908 40.5009L15.4106 38.2529Z"
                  fill="url(#paint0_linear_3092_23898)"
                />
                <path
                  d="M20 88C20 102.069 24.3636 115.791 32.4893 127.275C40.615 138.76 52.1028 147.442 65.3695 152.124C78.6361 156.806 93.0283 157.258 106.563 153.417C120.097 149.577 132.107 141.633 140.937 130.681C149.767 119.729 154.983 106.307 155.866 92.2666C156.749 78.2257 153.255 64.2567 145.866 52.2849C138.476 40.313 127.556 30.9277 114.609 25.4225C101.663 19.9173 87.3271 18.5632 73.5785 21.5468L74.4337 25.4873C87.367 22.6805 100.852 23.9543 113.031 29.1331C125.21 34.3119 135.483 43.1407 142.434 54.4027C149.385 65.6646 152.672 78.8053 151.842 92.0136C151.011 105.222 146.105 117.847 137.798 128.15C129.491 138.453 118.194 145.926 105.462 149.538C92.7302 153.151 79.1913 152.726 66.7114 148.321C54.2314 143.917 43.4248 135.75 35.7809 124.947C28.137 114.143 24.0322 101.234 24.0322 88H20Z"
                  fill="url(#paint1_linear_3092_23898)"
                />
                <path
                  d="M115.552 48.6952C110.391 45.077 104.567 42.5109 98.4138 41.1433C92.2605 39.7757 85.8981 39.6335 79.6899 40.7248C73.4816 41.8161 67.5491 44.1196 62.231 47.5036C56.9129 50.8876 52.3135 55.286 48.6952 60.4476C45.077 65.6091 42.5109 71.4328 41.1433 77.5861C39.7757 83.7395 39.6335 90.1019 40.7248 96.3101C41.8161 102.518 44.1196 108.451 47.5036 113.769C50.8876 119.087 55.286 123.687 60.4476 127.305L62.756 124.012C58.0268 120.697 53.997 116.483 50.8965 111.61C47.7959 106.738 45.6855 101.302 44.6856 95.6139C43.6858 89.9258 43.816 84.0964 45.069 78.4586C46.322 72.8209 48.6732 67.4851 51.9883 62.756C55.3034 58.0268 59.5175 53.997 64.39 50.8965C69.2625 47.7959 74.698 45.6855 80.3861 44.6856C86.0742 43.6858 91.9036 43.816 97.5414 45.069C103.179 46.322 108.515 48.6732 113.244 51.9883L115.552 48.6952Z"
                  fill="url(#paint2_linear_3092_23898)"
                />
                <defs>
                  <linearGradient
                    id="paint0_linear_3092_23898"
                    x1="166.222"
                    y1="87.9976"
                    x2="2.31009e-06"
                    y2="87.9976"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop offset="0%" stop-color="#864FFE" />
                    <stop offset="1" stop-color="#864FFE" stop-opacity="0.28" />
                  </linearGradient>
                  <linearGradient
                    id="paint1_linear_3092_23898"
                    x1="148.444"
                    y1="87.9982"
                    x2="20"
                    y2="87.9982"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop offset="0%" stop-color="#864FFE" />
                    <stop offset="1" stop-color="#864FFE" stop-opacity="0.28" />
                  </linearGradient>
                  <linearGradient
                    id="paint2_linear_3092_23898"
                    x1="130.667"
                    y1="87.9987"
                    x2="40"
                    y2="87.9987"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop offset="0%" stop-color="#864FFE" />
                    <stop offset="1" stop-color="#864FFE" stop-opacity="0.28" />
                  </linearGradient>
                </defs>
              </svg>

              <figure
                class="inline-block size-14 max-[426px]:size-10 rounded-full ring-4 ring-white bg-linear-[135deg,#ffffff_0%,#a585ff_100%] overflow-hidden absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >
                <img src="images/avatar/avatar-7.png" alt="avatar" class="max-w-full" />
                <img
                  src="images/avatar/author-avatar-bg.png"
                  alt="avatar"
                  class="absolute top-0 left-0 -z-10"
                />
              </figure>
            </div>
          </div>
        </div>
        <div
          data-ns-animate
          data-delay="0.5"
          data-direction="right"
          data-spring
          data-duration="2.5"
          class="flex flex-col sm:flex-row sm:items-center justify-start gap-6 p-6 rounded-2xl bg-secondary dark:bg-background-9 max-w-[420px] mt-4 sm:-mt-8 z-10 relative max-[426px]:rounded-xl"
        >
          <div class="flex -space-x-3.5">
            <img
              class="inline-block max-[426px]:size-10 size-14 rounded-full ring-4 ring-ns-yellow bg-white"
              src="images/avatar/avatar-1.png"
              alt="Avatar 1"
            />
            <img
              class="inline-block max-[426px]:size-10 size-14 rounded-full ring-4 ring-ns-yellow bg-white"
              src="images/avatar/avatar-2.png"
              alt="Avatar 2"
            />
            <img
              class="inline-block max-[426px]:size-10 size-14 rounded-full ring-4 ring-ns-yellow bg-white"
              src="images/avatar/avatar-3.png"
              alt="Avatar 3"
            />
          </div>

          <div>
            <h5 class="text-accent mb-1 max-[426px]:text-heading-6">Mischievous</h5>
            <p class="text-accent/60 max-[426px]:text-tagline-2">UI UX designer</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

    <!-- =========================
Pricing section
===========================-->
    <!-- <section
  class="relative pt-14 max-[426px]:pt-10 md:pt-16 lg:pt-[88px] xl:pt-[100px] pb-14 md:pb-16 lg:pb-[88px] xl:pb-[100px] bg-background-2 dark:bg-background-6 max-sm:overflow-hidden"
>
  <div class="main-container flex flex-col gap-[70px]">
    <div class="flex flex-col items-center text-center">
      <span data-ns-animate data-delay="0.1" class="badge badge-yellow mb-5 max-[426px]:mb-3">
        Our Pricing
      </span>
      <h2
        data-ns-animate
        data-delay="0.2"
        class="max-w-[650px] mx-auto mb-8 max-[426px]:max-w-[320px]"
      >
        Select the pricing plan that best suits your needs.
      </h2>

      <div class="relative z-0">
        <span
          data-ns-animate
          data-delay="0.5"
          data-direction="top"
          data-offset="100"
          data-spring
          data-duration="2.5"
          class="absolute z-11 -right-6 -top-2.5 bg-secondary dark:bg-accent text-accent dark:text-secondary inline-block font-normal capitalize text-tagline-2 px-3.5 py-1.5 shadow-xs rounded-[36px] rotate-[20deg] w-[90px]"
        >
          save 40%
        </span>
        <label
          data-ns-animate
          data-delay="0.3"
          class="relative inline-flex items-center cursor-pointer z-[10] bg-white dark:bg-background-9 py-6 px-[57px] max-[426px]:px-10 max-[426px]:py-4 rounded-full"
        >
          <span
            class="mr-2.5 text-tagline-1 max-[426px]:text-tagline-2 text-secondary dark:text-accent font-normal"
            >Monthly</span
          >
          <input
            type="checkbox"
            id="priceCheck"
            class="sr-only peer"
            aria-label="Toggle between monthly and yearly pricing"
          />
          <span
            class="relative w-13 h-[28px] bg-secondary dark:bg-accent rounded-[34px] peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:start-[2px] peer-checked:after:start-[2px] after:bg-accent dark:after:bg-background-8 after:rounded-full after:h-6 after:w-6 after:transition-all"
          ></span>
          <span
            class="ms-2.5 text-tagline-1 max-[426px]:text-tagline-2 text-secondary dark:text-accent font-normal"
            >Yearly</span
          >
        </label>
      </div>
    </div>
    <div class="relative">
      <div
        class="grid grid-cols-1 xl:grid-cols-3 items-center xl:gap-8 gap-y-5 xl:max-w-full max-w-[500px] mx-auto xl:mx-0"
      >
        <div
          data-ns-animate
          data-delay="0.4"
          class="bg-background-3 dark:bg-background-7 flex-1 p-8 rounded-[20px] max-lg:w-full w-full"
        >
          <h3 class="mb-2 font-normal text-heading-5">Simplified</h3>
          <p class="mb-6 max-w-[250px] max-[426px]:text-tagline-2">
            For individuals and small teams with unlimited trial access.
          </p>
          <div class="price-month mb-7">
            <h4 class="text-heading-4 font-normal">$<span>19.00</span></h4>
            <p class="text-secondary dark:text-accent">Per Month</p>
          </div>
          <div class="price-year mb-7">
            <h4 class="text-heading-4 font-normal">$<span>230.00</span></h4>
            <p class="text-secondary dark:text-accent">Per Year</p>
          </div>
          <a
            href="./contact-us-page.html"
            class="btn btn-md btn-white dark:btn-white-dark hover:btn-secondary dark:hover:btn-white w-full block text-center mb-8 before:content-none first-letter:uppercase"
          >
            Get started
          </a>
          <ul class="relative list-none space-y-2.5">
            <li class="flex items-center gap-2.5">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="shrink-0"
              >
                <rect
                  width="20"
                  height="20"
                  rx="10"
                  fill=""
                  class="fill-secondary dark:fill-accent"
                />
                <path
                  d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                  fill=""
                  class="fill-white dark:fill-black"
                />
              </svg>

              <span class="text-secondary dark:text-accent font-normal text-tagline-1"
                >Single Payment</span
              >
            </li>
            <li class="flex items-center gap-2.5">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="shrink-0"
              >
                <rect width="20" height="20" rx="10" fill="" class="fill-white dark:fill-black" />
                <path
                  d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                  fill=""
                  class="fill-secondary/60 dark:fill-accent/60"
                />
              </svg>

              <span class="text-secondary/60 dark:text-accent/60 font-normal text-tagline-1"
                >Selling your own items</span
              >
            </li>
            <li class="flex items-center gap-2.5">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="shrink-0"
              >
                <rect width="20" height="20" rx="10" fill="" class="fill-white dark:fill-black" />
                <path
                  d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                  fill=""
                  class="fill-secondary/60 dark:fill-accent/60"
                />
              </svg>

              <span class="text-secondary/60 dark:text-accent/60 font-normal text-tagline-1"
                >Powerful integration</span
              >
            </li>
          </ul>
        </div>

        <div
          data-ns-animate
          data-delay="0.5"
          class="p-2.5 w-full rounded-[20px] flex-1 bg-[url('/images/home-page-2/pricing-card-gradient.jpg')] dark:bg-[url('/images/home-page-2/price-bg-dark.png')] bg-no-repeat bg-center bg-cover max-lg:w-full"
        >
          <div class="bg-white dark:bg-black p-5 sm:p-8 rounded-[12px]">
            <h3 class="mb-2.5 font-normal text-heading-5">Basic</h3>
            <p class="mb-6 text-secondary/60 dark:text-accent/60 max-w-[250px]">
              For individuals and small teams with unlimited trial access.
            </p>
            <div class="price-month mb-7">
              <h4 class="text-heading-4 font-normal">$<span>3342.00</span></h4>
              <p class="text-secondary dark:text-accent">Per Month</p>
            </div>
            <div class="price-year mb-7">
              <h4 class="text-heading-4 font-normal">$<span>4420.00</span></h4>
              <p class="text-secondary dark:text-accent">Per Year</p>
            </div>
            <a
              href="./contact-us-page.html"
              class="btn btn-md btn-secondary dark:btn-accent hover:btn-white-v2 dark:hover:btn-white-dark w-full block text-center mb-8 before:content-none first-letter:uppercase"
            >
              Get started
            </a>
            <ul class="relative list-none space-y-2.5">
              <li class="flex items-center gap-2.5">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="shrink-0"
                >
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-secondary dark:fill-accent"
                  />
                  <path
                    d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                    fill=""
                    class="fill-white dark:fill-black"
                  />
                </svg>

                <span class="text-secondary dark:text-accent font-normal text-tagline-1"
                  >Unlimited Bandwidth</span
                >
              </li>
              <li class="flex items-center gap-2.5">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="shrink-0"
                >
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-secondary dark:fill-accent"
                  />
                  <path
                    d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                    fill=""
                    class="fill-white dark:fill-black"
                  />
                </svg>

                <span class="text-secondary dark:text-accent font-normal text-tagline-1"
                  >Promotional Tools</span
                >
              </li>
              <li class="flex items-center gap-2.5">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="shrink-0"
                >
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-secondary dark:fill-accent"
                  />
                  <path
                    d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                    fill=""
                    class="fill-white dark:fill-black"
                  />
                </svg>

                <span class="text-secondary dark:text-accent font-normal text-tagline-1"
                  >Single Payment</span
                >
              </li>
              <li class="flex items-center gap-2.5">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="shrink-0"
                >
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-secondary dark:fill-accent"
                  />
                  <path
                    d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                    fill=""
                    class="fill-white dark:fill-black"
                  />
                </svg>

                <span class="text-secondary dark:text-accent font-normal text-tagline-1"
                  >Single Payment</span
                >
              </li>
              <li class="flex items-center gap-2.5">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="shrink-0"
                >
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-background-4 dark:fill-background-9"
                  />
                  <path
                    d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                    fill=""
                    class="fill-secondary/60 dark:fill-accent/60"
                  />
                </svg>

                <span class="text-secondary/60 dark:text-accent/60 font-normal text-tagline-1"
                  >Selling your own items</span
                >
              </li>
              <li class="flex items-center gap-2.5">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="shrink-0"
                >
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-background-4 dark:fill-background-9"
                  />
                  <path
                    d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                    fill=""
                    class="fill-secondary/60 dark:fill-accent/60"
                  />
                </svg>

                <span class="text-secondary/60 dark:text-accent/60 font-normal text-tagline-1"
                  >Powerful integration</span
                >
              </li>
            </ul>
          </div>
        </div>

        <div
          data-ns-animate
          data-delay="0.6"
          class="bg-background-3 dark:bg-background-7 flex-1 p-8 rounded-[20px] max-lg:w-full"
        >
          <h3 class="mb-2 font-normal text-heading-5">Enhanced</h3>
          <p class="mb-6 max-w-[250px] text-secondary/60 dark:text-accent/60">
            For individuals and small teams with unlimited trial access.
          </p>
          <div class="price-month mb-7">
            <h4 class="text-heading-4 font-normal">$<span>4800.00</span></h4>
            <p class="text-secondary">Per Month</p>
          </div>
          <div class="price-year mb-7">
            <h4 class="text-heading-4 font-normal">$<span>5800.00</span></h4>
            <p class="text-secondary">Per Year</p>
          </div>
          <a
            href="./contact-us-page.html"
            class="btn btn-md btn-white dark:btn-white-dark hover:btn-secondary dark:hover:btn-white w-full block text-center mb-8 before:content-none first-letter:uppercase"
          >
            Get started
          </a>
          <ul class="relative list-none space-y-2.5">
            <li class="flex items-center gap-2.5">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="shrink-0"
              >
                <rect
                  width="20"
                  height="20"
                  rx="10"
                  fill=""
                  class="fill-secondary dark:fill-accent"
                />
                <path
                  d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                  fill=""
                  class="fill-white dark:fill-black"
                />
              </svg>

              <span class="text-secondary dark:text-accent font-normal text-tagline-1"
                >Selling on your own conditions</span
              >
            </li>
            <li class="flex items-center gap-2.5">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="shrink-0"
              >
                <rect
                  width="20"
                  height="20"
                  rx="10"
                  fill=""
                  class="fill-secondary dark:fill-accent"
                />
                <path
                  d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                  fill=""
                  class="fill-white dark:fill-black"
                />
              </svg>

              <span class="text-secondary dark:text-accent/60 font-normal text-tagline-1"
                >Seamless integrations</span
              >
            </li>
            <li class="flex items-center gap-2.5">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="shrink-0"
              >
                <rect width="20" height="20" rx="10" fill="" class="fill-white dark:fill-black" />
                <path
                  d="M9.31661 13.7561L14.7491 8.42144C15.0836 8.0959 15.0836 7.5697 14.7491 7.24416C14.4145 6.91861 13.8736 6.91861 13.539 7.24416L8.7116 11.9901L6.46096 9.78807C6.12636 9.46253 5.58554 9.46253 5.25095 9.78807C4.91635 10.1136 4.91635 10.6398 5.25095 10.9654L8.1066 13.7561C8.27347 13.9184 8.49253 14 8.7116 14C8.93067 14 9.14974 13.9184 9.31661 13.7561Z"
                  fill=""
                  class="fill-secondary/60 dark:fill-accent/60"
                />
              </svg>

              <span class="text-secondary/60 dark:text-accent/60 font-normal text-tagline-1"
                >Real-time streaming</span
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section> -->



    <!-- =========================
    Team section
    ===========================-->
    <section class=" dark:bg-background-6  py-[100px]">
      <div class="main-container">
        <div>
          <!-- team heading section   -->
          <div class="max-w-[620px] md:w-full text-center mx-auto mb-[70px]">
            <!-- badge  -->
            <span data-ns-animate data-delay="0.1" class="badge badge-green mb-5">Memorial Pages</span>

            <!-- heading  -->
            <h2 data-ns-animate data-delay="0.2" class="mb-3">
              Their Memory Lives On
            </h2>
            <p data-ns-animate data-delay="0.3">
              Browse the memorial pages created by families and friends to honor their loved ones.
            </p>
          </div>

          <form data-ns-animate data-delay="0.4" class="opacity-0 mb-[70px]">
            <div class="flex max-sm:flex-col max-sm:gap-y-5 w-full justify-center items-center gap-x-3">
              <input id="cta-email" type="email" placeholder="Enter memorial name" autocomplete="email"
                class="bg-background-1 dark:bg-background-6 min-w-[325px] sm:min-w-[340px] placeholder:text-secondary/40 dark:placeholder:text-white/40 text-secondary/60 text-tagline-1 focus:outline-none font-normal border border-stroke-3 rounded-[360px] dark:bg-dark-200 dark:border-[#31332F] focus:border-primary-500 dark:focus:border-primary-500 px-[18px] py-3 duration-300 transition-all outline-none h-12 placeholder:font-normal" />

              <button type="submit"
                class="btn btn-white-v2 hover:btn-secondary dark:hover:btn-accent btn-md h-12 max-sm:w-full">
                <span>Search</span>
              </button>
            </div>
          </form>

            @if($memorials->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 items-center gap-6 justify-center">

                @foreach($memorials as $memorial)
                <a href="{{ route('memorial.show', $memorial) }}">
                    <div data-ns-animate data-delay="0.4" class="w-[298px] h-[312px] space-y-[34px] mx-auto">

                        <figure class="size-[156px] rounded-full bg-[#d5dbe3] flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ $memorial->photo }}" class="object-cover size-full" alt="profile img" loading="lazy"/>
                        </figure>

                        <div class="space-y-[27px]">
                            <div class="text-center">
                                <h3 class="text-heading-5">{{ $memorial->name }}</h3>
                                <p class="text-tagline-2">{{ $memorial->birth_place }}</p>
                            </div>
                        </div>

                    </div>
                </a>
                @endforeach

            </div>
            @endif



          </div>

          <!-- team btn  -->
          <div class="flex items-center justify-center" data-ns-animate data-delay="0.8">
            <a href="./our-team-page-01.html"
              class="btn btn-md btn-secondary hover:btn-primary dark:btn-accent block md:inline-block w-[90%] md:w-auto mx-auto">
              <span>View all memorias</span>
            </a>
          </div>
        </div>
      </div>
    </section>


    <!-- =========================
    FAQ section
    ===========================-->
    <section class="py-28 bg-background-3 dark:bg-background-7">
      <div class="main-container">
        <div class="text-center space-y-5 max-w-[620px] mx-auto mb-[70px]">
          <span data-ns-animate data-delay="0.1" class="badge badge-green">FAQ</span>
          <div class="space-y-3">
            <h2 data-ns-animate data-delay="0.2">Commonly asked questions</h2>
            <p data-ns-animate data-delay="0.3">

            </p>
          </div>
        </div>
        <div data-ns-animate data-delay="0.4" class="accordion max-w-[770px] mx-auto space-y-6">
          <div class="accordion-item active-accordion bg-background-2 dark:bg-background-5 rounded-[20px] px-4 sm:px-8">
            <button class="accordion-action flex items-center cursor-pointer justify-between py-4 md:py-8 w-full">
              <span class="flex-1 text-left text-heading-6 font-normal text-secondary dark:text-accent">
                Is there an ongoing cost to maintain the website?
              </span>

              <!-- =========================
          Accordian Icon
          ===========================-->
              <span class="sm:ml-auto ml-2.5 block accordion-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16"
                  height="16">
                  <path stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 8.25-7.5 7.5-7.5-7.5" class="stroke-secondary dark:stroke-accent" />
                </svg>
              </span>

            </button>
            <div class="accordion-content">
              <div class="border-t border-t-stroke-2 dark:border-t-stroke-6 pt-6 pb-8">
                <p>
                  No! We are committed to affordability, offering a one-time purchase of a customizable Tribute
                  memorial. This service includes up to 50 photos, unlimited videos, and text storage for your online
                  tribute. For those who want to add even more memories, additional photo storage is available with an
                  annual subscription, so your loved one’s digital memorial is comprehensive and up-to-date.
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-item bg-background-2 dark:bg-background-5 rounded-[20px] px-4 sm:px-8">
            <button class="accordion-action flex items-center cursor-pointer justify-between py-4 md:py-8 w-full">
              <span class="flex-1 text-left text-heading-6 font-normal text-secondary dark:text-accent">
                Won't QR codes eventually be replaced by another technology?
              </span>
              <!-- =========================
          Accordian Icon
          ============================-->
              <span class="sm:ml-auto ml-2.5 block accordion-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16"
                  height="16">
                  <path stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 8.25-7.5 7.5-7.5-7.5" class="stroke-secondary dark:stroke-accent" />
                </svg>
              </span>

            </button>
            <div class="accordion-content">
              <div class="border-t border-t-stroke-2 dark:border-t-stroke-6 pt-6 pb-8">
                <p>
                  Experts believe that QR codes are here to stay, with their industrial roots continuing to play a
                  significant role in memorials. These codes do not store your loved one’s details; instead, they act as
                  a direct link to their personal page on our Tributes website. You can be assured that the information
                  is stored securely and is easily accessible. QR codes are considered a durable technology that ensures
                  that even as new technologies emerge, your digital memorial remains accessible and secure online.
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-item bg-background-2 dark:bg-background-5 rounded-[20px] px-4 sm:px-8">
            <button class="accordion-action flex items-center cursor-pointer justify-between py-4 md:py-8 w-full">
              <span class="flex-1 text-left text-heading-6 font-normal text-secondary dark:text-accent">
                Can I give the QR code to my family or friends as a gift?
              </span>
              <!-- =========================
            Accordian Icon
            ===========================-->
              <span class="sm:ml-auto ml-2.5 block accordion-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16"
                  height="16">
                  <path stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 8.25-7.5 7.5-7.5-7.5" class="stroke-secondary dark:stroke-accent" />
                </svg>
              </span>

            </button>
            <div class="accordion-content">
              <div class="border-t border-t-stroke-2 dark:border-t-stroke-6 pt-6 pb-8">
                <p>
                  Yes, you have the flexibility to create a digital memorial page for someone and then transfer
                  ownership of it to another person. The recipient simply needs to create an account on ourtributes.com.
                  Once their account is active, send an email with a transfer request that includes both parties’ email
                  addresses and the name of your loved one. Our team will efficiently handle the transfer of your online
                  tribute page.
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-item bg-background-2 dark:bg-background-5 rounded-[20px] px-4 sm:px-8">
            <button class="accordion-action flex items-center cursor-pointer justify-between py-4 md:py-8 w-full">
              <span class="flex-1 text-left text-heading-6 font-normal text-secondary dark:text-accent">
                Does the plaque damage the gravestone? What if I need to remove it later?
              </span>
              <!-- =========================
          Accordian Icon
          ===========================-->
              <span class="sm:ml-auto ml-2.5 block accordion-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16"
                  height="16">
                  <path stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 8.25-7.5 7.5-7.5-7.5" class="stroke-secondary dark:stroke-accent" />
                </svg>
              </span>

            </button>
            <div class="accordion-content">
              <div class="border-t border-t-stroke-2 dark:border-t-stroke-6 pt-6 pb-8">
                <p>
                  Our Rememus plaques do not damage the headstone! The 3M permanent tape adheres securely to the surface
                  even under harsh conditions such as rain, snow, strong sunlight, etc. However, if necessary, the
                  plaque can be carefully removed from the gravestone using a hard, flat object, such as a flathead
                  screwdriver, to gently pry the edges of the plaque away from the adhesive surface. After removal, use
                  an appropriate gravestone cleaner to remove any remaining sticky residue.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


  </main>
@endsection