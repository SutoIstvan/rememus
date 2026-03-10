  <header>
    <div
      class="header-one opacity-0 rounded-full lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] min-[500px]:max-w-[450px] min-[425px]:max-w-[375px] max-w-[320px] mx-auto w-full fixed left-1/2 -translate-x-1/2 z-50 top-5 flex items-center justify-between px-2.5 xl:py-0 py-2.5 bg-white/60 backdrop-blur-[25px] dark:bg-background-7 dark:border dark:border-stroke-7 max-[400px]:max-w-[340px]"
      data-ns-animate data-direction="up" data-offset="100">
      <div>
        <a href="{{ route('index') }}" class="flex items-center">
          <span class="sr-only">Home</span>
          <img src="logo.png" alt="NextSaaS" class="dark:invert max-w-[44px] lg:block hidden" />
          <div style="margin-left: 8px!important" class="text-xl dark:text-white lg:block hidden">
            Rememus<span class="text-secondary/60 dark:text-white">.com</span>
          </div>
          <figure class="max-w-[44px] lg:hidden block">
            <img src="logo.png" alt="NextSaaS" class="max-w-[44px] dark:hidden block" />
            <img src="./images/shared/logo-dark.svg" alt="NextSaaS" class="w-full dark:block hidden" />
          </figure>
        </a>
      </div>
      <nav class="hidden xl:flex items-center">
        <ul class="flex items-center">
          <li class="relative nav-item cursor-pointer py-2.5">
            <a href="{{ route('index') }}"
              class="flex items-center gap-1 px-4 py-2 border border-transparent hover:border-stroke-2 dark:hover:border-stroke-7 rounded-full text-tagline-1 font-normal text-secondary/60 hover:text-secondary transition-all duration-200 dark:text-accent/60 dark:hover:text-accent">
              <span>Home</span>
            </a>
          </li>
          <li class="relative nav-item cursor-pointer py-2.5" data-menu="company-mega-menu-v2">
            <a href="#"
              class="flex items-center gap-1 px-4 py-2 border border-transparent hover:border-stroke-2 dark:hover:border-stroke-7 rounded-full text-tagline-1 font-normal text-secondary/60 hover:text-secondary transition-all duration-200 dark:text-accent/60 dark:hover:text-accent">
              <span>Shop</span>
              <span class="nav-arrow block origin-center transition-all duration-300 translate-y-px">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </a>
            <div>
              <div
                class="dropdown-menu-bridge fixed left-1/2 -translate-x-1/2 top-full w-full h-3 z-40 lg:w-[946px] pointer-events-none bg-transparent opacity-0">
              </div>
              <div id="company-mega-menu-v2"
                class="dropdown-menu fixed left-1/2 -translate-x-1/2 top-full mt-2 pointer-events-none transition-all duration-300 opacity-0 max-w-[760px] lg:w-[760px] w-full bg-white dark:bg-background-6 z-50 rounded-[20px] p-4 flex items-start md:gap-x-6 gap-y-6 border border-stroke-1 dark:border-white/10">

                <div class="flex-1 space-y-3">
                  <ul class="space-y-2">
                    <li>
                      <a href="./ai-software-our-manifesto.html" class="flex items-start gap-2 p-3 relative group">
                        <div
                          class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                        </div>

                        <div
                          class="mt-1 size-7 shrink-0 rounded-lg p-1 border border-stroke-1 dark:border-white/10 flex items-center justify-center relative z-10">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" viewBox="0 0 24 24" fill="none">
                                        <path d="M2 16.9C2 15.5906 2 14.9359 2.29472 14.455C2.45963 14.1859 2.68589 13.9596 2.955 13.7947C3.43594 13.5 4.09063 13.5 5.4 13.5H6.5C8.38562 13.5 9.32843 13.5 9.91421 14.0858C10.5 14.6716 10.5 15.6144 10.5 17.5V18.6C10.5 19.9094 10.5 20.5641 10.2053 21.045C10.0404 21.3141 9.81411 21.5404 9.545 21.7053C9.06406 22 8.40937 22 7.1 22C5.13594 22 4.15391 22 3.4325 21.5579C3.02884 21.3106 2.68945 20.9712 2.44208 20.5675C2 19.8461 2 18.8641 2 16.9Z" stroke="#3f3f42" stroke-width="1.5"></path>
                                        <path d="M13.5 5.4C13.5 4.09063 13.5 3.43594 13.7947 2.955C13.9596 2.68589 14.1859 2.45963 14.455 2.29472C14.9359 2 15.5906 2 16.9 2C18.8641 2 19.8461 2 20.5675 2.44208C20.9712 2.68945 21.3106 3.02884 21.5579 3.4325C22 4.15391 22 5.13594 22 7.1C22 8.40937 22 9.06406 21.7053 9.545C21.5404 9.81411 21.3141 10.0404 21.045 10.2053C20.5641 10.5 19.9094 10.5 18.6 10.5H17.5C15.6144 10.5 14.6716 10.5 14.0858 9.91421C13.5 9.32843 13.5 8.38562 13.5 6.5V5.4Z" stroke="#3f3f42" stroke-width="1.5"></path>
                                        <path d="M16.5 6.25C16.5 5.73459 16.5 5.47689 16.6291 5.29493C16.6747 5.23072 16.7307 5.17466 16.7949 5.12911C16.9769 5 17.2346 5 17.75 5C18.2654 5 18.5231 5 18.7051 5.12911C18.7693 5.17466 18.8253 5.23072 18.8709 5.29493C19 5.47689 19 5.73459 19 6.25C19 6.76541 19 7.02311 18.8709 7.20507C18.8253 7.26928 18.7693 7.32534 18.7051 7.37089C18.5231 7.5 18.2654 7.5 17.75 7.5C17.2346 7.5 16.9769 7.5 16.7949 7.37089C16.7307 7.32534 16.6747 7.26928 16.6291 7.20507C16.5 7.02311 16.5 6.76541 16.5 6.25Z" fill="#3f3f42"></path>
                                        <path d="M12.75 22C12.75 22.4142 13.0858 22.75 13.5 22.75C13.9142 22.75 14.25 22.4142 14.25 22H12.75ZM14.3889 13.8371L14.8055 14.4607L14.8055 14.4607L14.3889 13.8371ZM13.8371 14.3889L13.2135 13.9722L13.2135 13.9722L13.8371 14.3889ZM19 12.75H17V14.25H19V12.75ZM12.75 19V22H14.25V19H12.75ZM17 12.75C16.3134 12.75 15.742 12.7491 15.281 12.796C14.8075 12.8441 14.3682 12.9489 13.9722 13.2135L14.8055 14.4607C14.914 14.3882 15.078 14.3244 15.4328 14.2883C15.8002 14.2509 16.2822 14.25 17 14.25V12.75ZM14.25 17C14.25 16.2822 14.2509 15.8002 14.2883 15.4328C14.3244 15.078 14.3882 14.914 14.4607 14.8055L13.2135 13.9722C12.9489 14.3682 12.8441 14.8075 12.796 15.281C12.7491 15.742 12.75 16.3134 12.75 17H14.25ZM13.9722 13.2135C13.6719 13.4141 13.4141 13.6719 13.2135 13.9722L14.4607 14.8055C14.5519 14.669 14.669 14.5519 14.8055 14.4607L13.9722 13.2135Z" fill="#3f3f42"></path>
                                        <path d="M22.75 13.5C22.75 13.0858 22.4142 12.75 22 12.75C21.5858 12.75 21.25 13.0858 21.25 13.5H22.75ZM20.7654 21.8478L21.0524 22.5407L21.0524 22.5407L20.7654 21.8478ZM21.8478 20.7654L21.1548 20.4784V20.4784L21.8478 20.7654ZM17 22.75H19V21.25H17V22.75ZM22.75 17V13.5H21.25V17H22.75ZM19 22.75C19.4557 22.75 19.835 22.7504 20.1454 22.7292C20.4625 22.7076 20.762 22.661 21.0524 22.5407L20.4784 21.1548C20.4012 21.1868 20.284 21.2163 20.0433 21.2327C19.7958 21.2496 19.4762 21.25 19 21.25V22.75ZM21.25 19C21.25 19.4762 21.2496 19.7958 21.2327 20.0433C21.2163 20.284 21.1868 20.4012 21.1548 20.4784L22.5407 21.0524C22.661 20.762 22.7076 20.4625 22.7292 20.1454C22.7504 19.835 22.75 19.4557 22.75 19H21.25ZM21.0524 22.5407C21.7262 22.2616 22.2616 21.7262 22.5407 21.0524L21.1548 20.4784C21.028 20.7846 20.7846 21.028 20.4784 21.1549L21.0524 22.5407Z" fill="#3f3f42"></path>
                                        <path d="M2 7.1C2 5.13594 2 4.15391 2.44208 3.4325C2.68945 3.02884 3.02884 2.68945 3.4325 2.44208C4.15391 2 5.13594 2 7.1 2C8.40937 2 9.06406 2 9.545 2.29472C9.81411 2.45963 10.0404 2.68589 10.2053 2.955C10.5 3.43594 10.5 4.09063 10.5 5.4V6.5C10.5 8.38562 10.5 9.32843 9.91421 9.91421C9.32843 10.5 8.38562 10.5 6.5 10.5H5.4C4.09063 10.5 3.43594 10.5 2.955 10.2053C2.68589 10.0404 2.45963 9.81411 2.29472 9.545C2 9.06406 2 8.40937 2 7.1Z" stroke="#3f3f42" stroke-width="1.5"></path>
                                        <path d="M5 6.25C5 5.73459 5 5.47689 5.12911 5.29493C5.17466 5.23072 5.23072 5.17466 5.29493 5.12911C5.47689 5 5.73459 5 6.25 5C6.76541 5 7.02311 5 7.20507 5.12911C7.26928 5.17466 7.32534 5.23072 7.37089 5.29493C7.5 5.47689 7.5 5.73459 7.5 6.25C7.5 6.76541 7.5 7.02311 7.37089 7.20507C7.32534 7.26928 7.26928 7.32534 7.20507 7.37089C7.02311 7.5 6.76541 7.5 6.25 7.5C5.73459 7.5 5.47689 7.5 5.29493 7.37089C5.23072 7.32534 5.17466 7.26928 5.12911 7.20507C5 7.02311 5 6.76541 5 6.25Z" fill="#3f3f42"></path>
                                        <path d="M5 17.75C5 17.2346 5 16.9769 5.12911 16.7949C5.17466 16.7307 5.23072 16.6747 5.29493 16.6291C5.47689 16.5 5.73459 16.5 6.25 16.5C6.76541 16.5 7.02311 16.5 7.20507 16.6291C7.26928 16.6747 7.32534 16.7307 7.37089 16.7949C7.5 16.9769 7.5 17.2346 7.5 17.75C7.5 18.2654 7.5 18.5231 7.37089 18.7051C7.32534 18.7693 7.26928 18.8253 7.20507 18.8709C7.02311 19 6.76541 19 6.25 19C5.73459 19 5.47689 19 5.29493 18.8709C5.23072 18.8253 5.17466 18.7693 5.12911 18.7051C5 18.5231 5 18.2654 5 17.75Z" fill="#3f3f42"></path>
                                        <path d="M16 17.75C16 17.0478 16 16.6967 16.1685 16.4444C16.2415 16.3352 16.3352 16.2415 16.4444 16.1685C16.6967 16 17.0478 16 17.75 16C18.4522 16 18.8033 16 19.0556 16.1685C19.1648 16.2415 19.2585 16.3352 19.3315 16.4444C19.5 16.6967 19.5 17.0478 19.5 17.75C19.5 18.4522 19.5 18.8033 19.3315 19.0556C19.2585 19.1648 19.1648 19.2585 19.0556 19.3315C18.8033 19.5 18.4522 19.5 17.75 19.5C17.0478 19.5 16.6967 19.5 16.4444 19.3315C16.3352 19.2585 16.2415 19.1648 16.1685 19.0556C16 18.8033 16 18.4522 16 17.75Z" fill="#3f3f42"></path>
                                      </svg>

                        </div>
                        <div class="relative z-10">
                          <p class="text-tagline-1 font-normal text-secondary dark:text-accent">
                            Black Plate
                          </p>
                          <p class="text-tagline-2 font-normal text-secondary/60 dark:text-accent/60">
                            Best suited for light or gray monuments.
                          </p>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a href="./ai-software-customer.html" class="flex items-start gap-2 p-3 relative group">
                        <div
                          class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                        </div>

                        <div
                          class="mt-1 size-7 shrink-0 rounded-lg p-1 border border-stroke-1 dark:border-white/10 flex items-center justify-center relative z-10">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" viewBox="0 0 24 24" fill="none">
                                        <path d="M2 16.9C2 15.5906 2 14.9359 2.29472 14.455C2.45963 14.1859 2.68589 13.9596 2.955 13.7947C3.43594 13.5 4.09063 13.5 5.4 13.5H6.5C8.38562 13.5 9.32843 13.5 9.91421 14.0858C10.5 14.6716 10.5 15.6144 10.5 17.5V18.6C10.5 19.9094 10.5 20.5641 10.2053 21.045C10.0404 21.3141 9.81411 21.5404 9.545 21.7053C9.06406 22 8.40937 22 7.1 22C5.13594 22 4.15391 22 3.4325 21.5579C3.02884 21.3106 2.68945 20.9712 2.44208 20.5675C2 19.8461 2 18.8641 2 16.9Z" stroke="#3f3f42" stroke-width="1.5"></path>
                                        <path d="M13.5 5.4C13.5 4.09063 13.5 3.43594 13.7947 2.955C13.9596 2.68589 14.1859 2.45963 14.455 2.29472C14.9359 2 15.5906 2 16.9 2C18.8641 2 19.8461 2 20.5675 2.44208C20.9712 2.68945 21.3106 3.02884 21.5579 3.4325C22 4.15391 22 5.13594 22 7.1C22 8.40937 22 9.06406 21.7053 9.545C21.5404 9.81411 21.3141 10.0404 21.045 10.2053C20.5641 10.5 19.9094 10.5 18.6 10.5H17.5C15.6144 10.5 14.6716 10.5 14.0858 9.91421C13.5 9.32843 13.5 8.38562 13.5 6.5V5.4Z" stroke="#3f3f42" stroke-width="1.5"></path>
                                        <path d="M16.5 6.25C16.5 5.73459 16.5 5.47689 16.6291 5.29493C16.6747 5.23072 16.7307 5.17466 16.7949 5.12911C16.9769 5 17.2346 5 17.75 5C18.2654 5 18.5231 5 18.7051 5.12911C18.7693 5.17466 18.8253 5.23072 18.8709 5.29493C19 5.47689 19 5.73459 19 6.25C19 6.76541 19 7.02311 18.8709 7.20507C18.8253 7.26928 18.7693 7.32534 18.7051 7.37089C18.5231 7.5 18.2654 7.5 17.75 7.5C17.2346 7.5 16.9769 7.5 16.7949 7.37089C16.7307 7.32534 16.6747 7.26928 16.6291 7.20507C16.5 7.02311 16.5 6.76541 16.5 6.25Z" fill="#3f3f42"></path>
                                        <path d="M12.75 22C12.75 22.4142 13.0858 22.75 13.5 22.75C13.9142 22.75 14.25 22.4142 14.25 22H12.75ZM14.3889 13.8371L14.8055 14.4607L14.8055 14.4607L14.3889 13.8371ZM13.8371 14.3889L13.2135 13.9722L13.2135 13.9722L13.8371 14.3889ZM19 12.75H17V14.25H19V12.75ZM12.75 19V22H14.25V19H12.75ZM17 12.75C16.3134 12.75 15.742 12.7491 15.281 12.796C14.8075 12.8441 14.3682 12.9489 13.9722 13.2135L14.8055 14.4607C14.914 14.3882 15.078 14.3244 15.4328 14.2883C15.8002 14.2509 16.2822 14.25 17 14.25V12.75ZM14.25 17C14.25 16.2822 14.2509 15.8002 14.2883 15.4328C14.3244 15.078 14.3882 14.914 14.4607 14.8055L13.2135 13.9722C12.9489 14.3682 12.8441 14.8075 12.796 15.281C12.7491 15.742 12.75 16.3134 12.75 17H14.25ZM13.9722 13.2135C13.6719 13.4141 13.4141 13.6719 13.2135 13.9722L14.4607 14.8055C14.5519 14.669 14.669 14.5519 14.8055 14.4607L13.9722 13.2135Z" fill="#3f3f42"></path>
                                        <path d="M22.75 13.5C22.75 13.0858 22.4142 12.75 22 12.75C21.5858 12.75 21.25 13.0858 21.25 13.5H22.75ZM20.7654 21.8478L21.0524 22.5407L21.0524 22.5407L20.7654 21.8478ZM21.8478 20.7654L21.1548 20.4784V20.4784L21.8478 20.7654ZM17 22.75H19V21.25H17V22.75ZM22.75 17V13.5H21.25V17H22.75ZM19 22.75C19.4557 22.75 19.835 22.7504 20.1454 22.7292C20.4625 22.7076 20.762 22.661 21.0524 22.5407L20.4784 21.1548C20.4012 21.1868 20.284 21.2163 20.0433 21.2327C19.7958 21.2496 19.4762 21.25 19 21.25V22.75ZM21.25 19C21.25 19.4762 21.2496 19.7958 21.2327 20.0433C21.2163 20.284 21.1868 20.4012 21.1548 20.4784L22.5407 21.0524C22.661 20.762 22.7076 20.4625 22.7292 20.1454C22.7504 19.835 22.75 19.4557 22.75 19H21.25ZM21.0524 22.5407C21.7262 22.2616 22.2616 21.7262 22.5407 21.0524L21.1548 20.4784C21.028 20.7846 20.7846 21.028 20.4784 21.1549L21.0524 22.5407Z" fill="#3f3f42"></path>
                                        <path d="M2 7.1C2 5.13594 2 4.15391 2.44208 3.4325C2.68945 3.02884 3.02884 2.68945 3.4325 2.44208C4.15391 2 5.13594 2 7.1 2C8.40937 2 9.06406 2 9.545 2.29472C9.81411 2.45963 10.0404 2.68589 10.2053 2.955C10.5 3.43594 10.5 4.09063 10.5 5.4V6.5C10.5 8.38562 10.5 9.32843 9.91421 9.91421C9.32843 10.5 8.38562 10.5 6.5 10.5H5.4C4.09063 10.5 3.43594 10.5 2.955 10.2053C2.68589 10.0404 2.45963 9.81411 2.29472 9.545C2 9.06406 2 8.40937 2 7.1Z" stroke="#3f3f42" stroke-width="1.5"></path>
                                        <path d="M5 6.25C5 5.73459 5 5.47689 5.12911 5.29493C5.17466 5.23072 5.23072 5.17466 5.29493 5.12911C5.47689 5 5.73459 5 6.25 5C6.76541 5 7.02311 5 7.20507 5.12911C7.26928 5.17466 7.32534 5.23072 7.37089 5.29493C7.5 5.47689 7.5 5.73459 7.5 6.25C7.5 6.76541 7.5 7.02311 7.37089 7.20507C7.32534 7.26928 7.26928 7.32534 7.20507 7.37089C7.02311 7.5 6.76541 7.5 6.25 7.5C5.73459 7.5 5.47689 7.5 5.29493 7.37089C5.23072 7.32534 5.17466 7.26928 5.12911 7.20507C5 7.02311 5 6.76541 5 6.25Z" fill="#3f3f42"></path>
                                        <path d="M5 17.75C5 17.2346 5 16.9769 5.12911 16.7949C5.17466 16.7307 5.23072 16.6747 5.29493 16.6291C5.47689 16.5 5.73459 16.5 6.25 16.5C6.76541 16.5 7.02311 16.5 7.20507 16.6291C7.26928 16.6747 7.32534 16.7307 7.37089 16.7949C7.5 16.9769 7.5 17.2346 7.5 17.75C7.5 18.2654 7.5 18.5231 7.37089 18.7051C7.32534 18.7693 7.26928 18.8253 7.20507 18.8709C7.02311 19 6.76541 19 6.25 19C5.73459 19 5.47689 19 5.29493 18.8709C5.23072 18.8253 5.17466 18.7693 5.12911 18.7051C5 18.5231 5 18.2654 5 17.75Z" fill="#3f3f42"></path>
                                        <path d="M16 17.75C16 17.0478 16 16.6967 16.1685 16.4444C16.2415 16.3352 16.3352 16.2415 16.4444 16.1685C16.6967 16 17.0478 16 17.75 16C18.4522 16 18.8033 16 19.0556 16.1685C19.1648 16.2415 19.2585 16.3352 19.3315 16.4444C19.5 16.6967 19.5 17.0478 19.5 17.75C19.5 18.4522 19.5 18.8033 19.3315 19.0556C19.2585 19.1648 19.1648 19.2585 19.0556 19.3315C18.8033 19.5 18.4522 19.5 17.75 19.5C17.0478 19.5 16.6967 19.5 16.4444 19.3315C16.3352 19.2585 16.2415 19.1648 16.1685 19.0556C16 18.8033 16 18.4522 16 17.75Z" fill="#3f3f42"></path>
                                      </svg>

                        </div>
                        <div class="relative z-10">
                          <p class="text-tagline-1 font-normal text-secondary dark:text-accent">Gray Plate</p>
                          <p class="text-tagline-2 font-normal text-secondary/60 dark:text-accent/60">
                            Perfect match for black monuments.
                          </p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="./ai-software-testimonial.html" class="flex items-start gap-2 p-3 relative group">
                        <div
                          class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                        </div>

                        <div
                          class="mt-1 size-7 shrink-0 rounded-lg p-1 border border-stroke-1 dark:border-white/10 flex items-center justify-center relative z-10">
                          <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" viewBox="0 0 28 28" fill="none"><path d="M17.6303 2.00835C17.1887 2.02364 16.8409 2.39407 16.8535 2.83572L16.893 4.22187C16.9056 4.66352 17.2738 5.00915 17.7153 4.99386L17.9424 4.986C18.384 4.97071 18.7318 4.60028 18.7192 4.15863L18.6797 2.77248C18.6671 2.33083 18.299 1.9852 17.8574 2.00049L17.6303 2.00835Z" fill="#000000"/><path d="M26.1834 5.68334C25.933 5.31933 25.4445 5.24051 25.0923 5.5073L24.0641 6.28621C23.7119 6.553 23.6294 7.06436 23.8798 7.42838L24.0423 7.66455C24.2927 8.02857 24.7812 8.10738 25.1334 7.84059L26.1616 7.06169C26.5138 6.7949 26.5963 6.28353 26.3459 5.91952L26.1834 5.68334Z" fill="#000000"/><path d="M24.5987 15.8795C24.217 15.657 24.0749 15.1599 24.2814 14.7693L24.4192 14.5085C24.6256 14.1179 25.1024 13.9816 25.4841 14.2042L26.588 14.8478C26.9697 15.0704 27.1118 15.5674 26.9053 15.9581L26.7675 16.2188C26.5611 16.6095 26.0843 16.7458 25.7026 16.5232L24.5987 15.8795Z" fill="#000000"/><path d="M10.0396 7.20252C9.8527 7.60289 10.0198 8.09118 10.4127 8.29314L11.5421 8.87356C11.9351 9.07553 12.4051 8.91469 12.592 8.51432L12.7188 8.24251C12.9057 7.84214 12.7386 7.35385 12.3456 7.15189L11.2163 6.57147C10.8233 6.3695 10.3533 6.53034 10.1664 6.93071L10.0396 7.20252Z" fill="#000000"/><path clip-rule="evenodd" d="M4.65859 16.0856C5.54865 12.5572 8.51157 9.86796 12.151 9.86796C12.3844 9.86796 12.6151 9.87905 12.8426 9.90075C13.6426 7.66013 15.7953 6.05543 18.3253 6.05543C21.5372 6.05543 24.141 8.64175 24.141 11.8321C24.141 13.4713 23.4536 14.9511 22.3496 16.0025C23.0757 16.6926 23.5809 17.6336 23.7664 18.6739C25.1525 18.8619 26.1041 20.14 26.1041 21.5142C26.1041 23.0026 24.9878 24.3783 23.4121 24.3783H22.8481C22.8139 24.3783 22.7799 24.3765 22.746 24.373L5.01622 24.3783C4.95842 24.3812 4.90034 24.3827 4.84201 24.3827H4.25598C4.18257 24.3827 4.10938 24.3746 4.03774 24.3586C2.19186 23.9457 1 22.0472 1 20.1889C1 18.0677 2.54244 16.1774 4.65859 16.0856ZM14.7459 10.3494C16.7606 11.1254 18.3722 12.7766 19.2315 14.8418C19.3098 14.8358 19.3867 14.8338 19.461 14.8338C19.843 14.8338 20.2103 14.885 20.5584 14.9807C21.5529 14.2835 22.2024 13.1332 22.2024 11.8321C22.2024 9.70521 20.4666 7.981 18.3253 7.981C16.713 7.981 15.3306 8.95852 14.7459 10.3494ZM12.151 11.868C9.34766 11.868 6.90224 14.1488 6.45462 17.3041C6.41465 17.5858 6.25657 17.8371 6.01996 17.9952C5.78335 18.1532 5.49062 18.203 5.21508 18.132C5.08852 18.0994 4.95652 18.0821 4.81998 18.0821C3.90377 18.0821 3 18.932 3 20.1889C3 21.289 3.68512 22.1681 4.38346 22.3827H4.84201C4.87123 22.3827 4.90016 22.3818 4.9288 22.3801C4.94864 22.3789 4.96851 22.3783 4.98838 22.3783L22.8337 22.373C22.8681 22.373 22.9023 22.3748 22.9364 22.3783H23.4121C23.7053 22.3783 24.1041 22.0848 24.1041 21.5142C24.1041 20.9436 23.7053 20.6501 23.4121 20.6501C23.3406 20.6501 23.2727 20.6636 23.2081 20.6892C22.8924 20.814 22.5348 20.7702 22.2587 20.5727C21.9825 20.3752 21.8253 20.0511 21.8414 19.712C21.8437 19.6624 21.8449 19.6124 21.8449 19.562C21.8449 17.9671 20.6962 16.8412 19.473 16.8338L19.4644 16.8401C19.3687 16.9101 19.2489 16.9885 19.0868 17.0707C18.8187 17.2067 18.5036 17.2148 18.2288 17.0928C17.954 16.9708 17.7487 16.7316 17.6697 16.4415C16.9329 13.7352 14.6928 11.868 12.151 11.868Z" fill="#000000" fill-rule="evenodd"/></svg>

                        </div>
                        <div class="relative z-10">
                          <p class="text-tagline-1 font-normal text-secondary dark:text-accent">3M Adhesive</p>
                          <p class="text-tagline-2 font-normal text-secondary/60 dark:text-accent/60">
                            Weather-resistant adhesive
                          </p>
                        </div>
                      </a>
                    </li>

                  </ul>
                </div>
                <div class="flex-1">
                  <div class="space-y-3">

                  </div>
                  <!-- <p class="p-3 text-tagline-2 font-medium text-secondary/60 dark:text-accent/60">Shop</p> -->
                  <div>
                    <figure class="overflow-hidden rounded-[14px] max-w-full w-full min-h-[166px] relative group">
                      <img src="./images/ns-img-422.jpg" alt="Product Image"
                        class="w-full h-full object-cover rounded-[14px]" />

                      <div class="absolute top-3 left-3 bottom-3 w-full space-y-5 p-2">
                        <div>
                          <p class="text-tagline-1 font-normal text-secondary">Product</p>
                          <p class="max-w-[169px] w-full text-tagline-2 font-normal text-secondary/60">
                            You can choose the plate color that best fits the memorial.
                          </p>
                        </div>
                        <a href="./ai-software-documentation.html"
                          class="group-hover:bg-primary-500 group bg-secondary transition-all duration-500 ease-in-out ring-[6px] ring-white rounded-[40px] w-16 relative overflow-hidden flex items-center justify-center space-y-5 h-9.5 px-5 py-2">
                          <figure class="size-6 relative items-center justify-center overflow-hidden">
                            <img src="./images/icons/new-arrow-white.svg" alt="new-arrow"
                              class="size-full absolute inset-0 -translate-x-6 object-cover group-hover:translate-x-1 transition-transform duration-400 ease-in-out" />
                            <img src="./images/icons/new-arrow-white.svg" alt="new-arrow"
                              class="size-full object-cover group-hover:translate-x-6 transition-transform duration-400 ease-in-out" />
                          </figure>
                        </a>
                      </div>
                    </figure>
                  </div>
                </div>
              </div>
            </div>

          </li>
          <li class="relative nav-item cursor-pointer py-2.5" data-menu="platform-mega-menu-v2">
            <a href="#"
              class="flex items-center gap-1 px-4 py-2 border border-transparent hover:border-stroke-2 dark:hover:border-stroke-7 rounded-full text-tagline-1 font-normal text-secondary/60 hover:text-secondary transition-all duration-200 dark:text-accent/60 dark:hover:text-accent">
              <span>Help</span>
              <span class="nav-arrow block origin-center transition-all duration-300 translate-y-px">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </a>
            <div>
              <div
                class="dropdown-menu-bridge fixed left-1/2 -translate-x-1/2 top-full w-full h-3 z-40 lg:w-[946px] pointer-events-none bg-transparent opacity-0">
              </div>
              <div id="platform-mega-menu-v2"
                class="dropdown-menu fixed left-1/2 -translate-x-1/2 top-full mt-2 pointer-events-none transition-all duration-300 opacity-0 lg:w-[946px] w-full bg-white dark:bg-background-6 z-50 rounded-[20px] p-4 border border-stroke-1 dark:border-white/10">
                <div class="grid grid-cols-12 items-start md:gap-x-6 gap-y-6">
                  <div class="col-span-12 lg:col-span-4 grid grid-cols-12 gap-x-6">
                    <div class="col-span-12 xl:col-span-12">
                      <div>
                        <p class="text-tagline-2 font-medium text-secondary/60 dark:text-accent/60 p-3">
                          Overview
                        </p>
                        <ul>
                          <li>
                            <a href="./help#step1" class="relative block group p-3">
                              <div
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                              </div>

                              <span class="text-tagline-1 font-normal text-secondary dark:text-accent relative z-10">
                                Features & Capabilities
                              </span>
                            </a>
                          </li>
                          <li>
                            <a href="./help#step2" class="relative block group p-3">
                              <div
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                              </div>

                              <span class="text-tagline-1 font-normal text-secondary dark:text-accent relative z-10">
                                Process & Workflow
                              </span>
                            </a>
                          </li>
                          <li>
                            <a href="./help#step3" class="relative block group p-3">
                              <div
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                              </div>

                              <span class="text-tagline-1 font-normal text-secondary dark:text-accent relative z-10">
                                Security & Compliance
                              </span>
                            </a>
                          </li>
                          <li>
                            <a href="./help#step4" class="relative block group p-3">
                              <div
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                              </div>

                              <span class="text-tagline-1 font-normal text-secondary dark:text-accent relative z-10">
                                Our Brandkit
                              </span>
                            </a>
                          </li>
                          <li>
                            <a href="./help#step5" class="relative block group p-3">
                              <div
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                              </div>

                              <span class="text-tagline-1 font-normal text-secondary dark:text-accent relative z-10">
                                Download App
                              </span>
                            </a>
                          </li>
                          <li>
                            <a href="./help#step6" class="relative block group p-3">
                              <div
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 {=$class}">
                              </div>

                              <span class="text-tagline-1 font-normal text-secondary dark:text-accent relative z-10">
                                Press
                              </span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                  <div class="col-span-12 lg:col-span-8 grid grid-cols-12 gap-x-6">
                    <div class="col-span-12 xl:col-span-6">
                      <a href="./ai-software-blog-details.html" class="block">
                        <article
                          class="p-3 border border-stroke-1 dark:border-background-7 rounded-2xl space-y-3 group">
                          <figure class="rounded-lg overflow-hidden">
                            <img src="./images/ns-img-424.jpg" alt="Featured"
                              class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition-transform duration-500 ease-in-out" />
                          </figure>
                          <div class="space-y-14">
                            <div>
                              <p class="text-heading-6 font-normal text-secondary dark:text-accent">
                                Merge Unified
                              </p>
                              <p class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60">
                                One API. Countless product <br />
                                integrations.
                              </p>
                            </div>
                            <div>
                              <a href="./ai-software-blog-details.html"
                                class="bg-secondary group group-hover:bg-primary-500 transition-all duration-500 ease-in-out ring-[6px] ring-background-12 dark:ring-background-7 rounded-full w-16 relative overflow-hidden flex items-center justify-center space-y-5 h-9.5 px-5 py-2">
                                <figure class="size-6 relative items-center justify-center overflow-hidden">
                                  <img src="./images/icons/new-arrow-white.svg" alt="new-arrow"
                                    class="size-full absolute inset-0 -translate-x-6 object-cover group-hover:translate-x-1 transition-transform duration-400 ease-in-out" />
                                  <img src="./images/icons/new-arrow-white.svg" alt="new-arrow"
                                    class="size-full object-cover group-hover:translate-x-6 transition-transform duration-400 ease-in-out" />
                                </figure>
                              </a>
                            </div>
                          </div>
                        </article>
                      </a>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                      <a href="./ai-software-blog-details.html" class="block">
                        <article
                          class="p-3 border border-stroke-1 dark:border-background-7 rounded-2xl space-y-3 group">
                          <figure class="rounded-lg overflow-hidden">
                            <img src="./images/ns-img-425.jpg" alt="Featured"
                              class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition-transform duration-500 ease-in-out" />
                          </figure>
                          <div class="space-y-14">
                            <div>
                              <p class="text-heading-6 font-normal text-secondary dark:text-accent">
                                Combine Unified
                              </p>
                              <p class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60">
                                One API. Countless product <br />
                                integrations.
                              </p>
                            </div>
                            <div>
                              <a href="./ai-software-blog-details.html"
                                class="bg-secondary group group-hover:bg-primary-500 transition-all duration-500 ease-in-out ring-[6px] ring-background-12 dark:ring-background-7 rounded-full w-16 relative overflow-hidden flex items-center justify-center space-y-5 h-9.5 px-5 py-2">
                                <figure class="size-6 relative items-center justify-center overflow-hidden">
                                  <img src="./images/icons/new-arrow-white.svg" alt="new-arrow"
                                    class="size-full absolute inset-0 -translate-x-6 object-cover group-hover:translate-x-1 transition-transform duration-400 ease-in-out" />
                                  <img src="./images/icons/new-arrow-white.svg" alt="new-arrow"
                                    class="size-full object-cover group-hover:translate-x-6 transition-transform duration-400 ease-in-out" />
                                </figure>
                              </a>
                            </div>
                          </div>
                        </article>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </li>


          <li class="relative nav-item cursor-pointer py-2.5">
            <a href="{{ route('pricing') }}"
              class="flex items-center gap-1 px-4 py-2 border border-transparent hover:border-stroke-2 dark:hover:border-stroke-7 rounded-full text-tagline-1 font-normal text-secondary/60 hover:text-secondary transition-all duration-200 dark:text-accent/60 dark:hover:text-accent">
              <span>Pricing</span>
            </a>
          </li>
          <li class="relative nav-item cursor-pointer py-2.5">
            <a href="./ai-software-pricing.html"
              class="flex items-center gap-1 px-4 py-2 border border-transparent hover:border-stroke-2 dark:hover:border-stroke-7 rounded-full text-tagline-1 font-normal text-secondary/60 hover:text-secondary transition-all duration-200 dark:text-accent/60 dark:hover:text-accent">
              <span>Contact</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="xl:flex hidden items-center justify-center">
        <a href="./signup-page-01.html"
          class="btn btn-md btn-secondary dark:btn-accent dark:hover:btn-white-dark hover:btn-white">
          <span>Get started</span>
        </a>
      </div>
      <div class="xl:hidden block">
        <button
          class="nav-hamburger flex flex-col gap-[5px] size-12 bg-background-4 dark:bg-background-6 rounded-full items-center justify-center cursor-pointer">
          <span class="sr-only">Menu</span>
          <span class="block w-6 h-0.5 bg-stroke-9 dark:bg-stroke-1"></span>
          <span class="block w-6 h-0.5 bg-stroke-9 dark:bg-stroke-1"></span>
          <span class="block w-6 h-0.5 bg-stroke-9 dark:bg-stroke-1"></span>
        </button>
      </div>
    </div>
    <!-- =========================
    Mobile Menu
    ===========================-->

    <aside
      class="sidebar fixed top-0 right-0 w-full sm:w-1/2 translate-x-full transition-all duration-300 h-screen bg-white dark:bg-background-7 xl:hidden z-[999] scroll-bar">
      <div class="lg:p-9 sm:p-8 p-5 space-y-4">
        <div class="flex items-center justify-between">
          <a href="./">
            <span class="sr-only">Home</span>
            <figure class="max-w-[44px]">
              <img src="logo.png" alt="NextSaaS" class="w-full dark:hidden block" />
              <img src="./images/shared/logo-dark.svg" alt="NextSaaS" class="w-full dark:block hidden" />
            </figure>
          </a>
          <button
            class="nav-hamburger-close flex flex-col gap-1.5 size-10 bg-background-4 dark:bg-background-9 rounded-full items-center justify-center cursor-pointer relative">
            <span class="sr-only">Close Menu</span>
            <span class="block w-4 h-0.5 bg-stroke-9/60 dark:bg-stroke-1 rotate-45 absolute"></span>
            <span class="block w-4 h-0.5 bg-stroke-9/60 dark:bg-stroke-1 -rotate-45 absolute"></span>
          </button>
        </div>
        <div class="h-[85vh] w-full overflow-y-auto overflow-x-hidden pb-10 scroll-bar">
          <ul>
            <!-- home menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Home</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 overflow-y-auto">
                <ul>
                  <li>
                    <a href="index.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      1. Crypto Marketing
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      2. AI Software
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      3. AI Chatbot
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-04.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      4. Web Hosting
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-05.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      5. Analytics & Reporting
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-06.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      6. Financial Application
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-07.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      7. Payment Solutions
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-08.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      8. Online Banking
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-09.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      9. Cloud Based Software
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-10.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      10. Cyber Security
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-11.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      11. Email Marketing
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-12.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      12. Lead Capture
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-13.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      13. Messaging Platform
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-14.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      14. Mortgage Services
                    </a>
                  </li>
                  <li>
                    <a href="./home-page-15.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      15. Creative Portfolio
                    </a>
                  </li>

                </ul>
              </div>
            </li>


            <!-- about us menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>About us</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./about-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      About us 01
                    </a>
                  </li>
                  <li>
                    <a href="./about-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      About us 02
                    </a>
                  </li>
                  <li>
                    <a href="./about-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      About us 03
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- blog menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Blog</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./blog-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Blog Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./blog-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Blog Page 02
                    </a>
                  </li>
                  <li>
                    <a href="./blog-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Blog Page 03
                    </a>
                  </li>
                  <li>
                    <a href="./blog-details-page.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Blog Details
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- services menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Our Services</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./our-services-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Our Services Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./our-services-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Our Services Page 02
                    </a>
                  </li>
                  <li>
                    <a href="./our-services-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Our Services Page 03
                    </a>
                  </li>
                  <li>
                    <a href="./our-services-details-page.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Our Services Details
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- integration menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Integration</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./integration-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Integration Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./integration-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Integration Page 02
                    </a>
                  </li>
                  <li>
                    <a href="./integration-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Integration Page 03
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- features menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Features</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./features-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Features Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./features-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Features Page 02
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- process menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Process</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./process-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Process Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./process-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Process Page 02
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- testimonial menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Testimonials</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./testimonial-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Testimonials Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./testimonial-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Testimonials Page 02
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- teams menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Teams</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./our-team-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Our team 01
                    </a>
                  </li>
                  <li>
                    <a href="./our-team-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Our team 02
                    </a>
                  </li>
                  <li>
                    <a href="./team-details-page.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Team details
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- pricing menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Pricing</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./pricing-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Pricing Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./pricing-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Pricing Page 02
                    </a>
                  </li>
                  <li>
                    <a href="./pricing-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Pricing Page 03
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- login menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Login</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./login-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Login Page 01
                    </a>
                  </li>
                  <li>
                    <a href="./login-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Login Page 02
                    </a>
                  </li>
                  <li>
                    <a href="./login-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Login Page 03
                    </a>
                  </li>
                  <li>
                    <a href="./login-page-04.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Login Page 04
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- sign up menu  -->
            <li class="relative space-y-0">
              <button
                class="sub-menu text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left flex items-center justify-between cursor-pointer">
                <span>Sign up</span>
                <span class="sub-menu-arrow transition-all duration-300">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 12L12 8L8 4" class="stroke-secondary dark:stroke-accent" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </button>
              <div
                class="hidden ml-3.5 transition-all duration-300 w-full bg-white dark:bg-background-7 max-h-[500px] overflow-y-auto scroll-bar">
                <ul>
                  <li>
                    <a href="./signup-page-01.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Sign up 01
                    </a>
                  </li>
                  <li>
                    <a href="./signup-page-02.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Sign up 02
                    </a>
                  </li>
                  <li>
                    <a href="./signup-page-03.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 border-b border-stroke-4 dark:border-stroke-6 w-full text-left block">
                      Sign up 03
                    </a>
                  </li>
                  <li>
                    <a href="./signup-page-04.html"
                      class="text-tagline-1 font-normal text-secondary/60 dark:text-accent/60 transition-all duration-200 py-3 w-full text-left block">
                      Sign up 04
                    </a>
                  </li>
                </ul>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </aside>

  </header>