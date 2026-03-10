@extends('layouts.app')

@section('content')
<main>

  <section class="xl:pt-[180px] md:pt-42 sm:pt-36 pt-32 {=$class}" aria-label="Page hero section">
    <div class="main-container">
      <!-- Hero content -->
      <div class="text-center space-y-2 pb-14 lg:pb-[72px]">
        <span
          data-ns-animate
          data-delay="0.1"
          class="hero-badge text-tagline-1 inline-block text-secondary dark:text-accent"
        >
          <a
            href="./index.html"
            class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300"
            >Home</a
          >
          <span class="mx-2">-</span>
          <a
            href="#"
            class="hover:text-primary-500 dark:hover:text-primary-400 transition-colors duration-300"
            >Pricing-2</a
          >
        </span>
        <h1 data-ns-animate data-delay="0.2" class="font-normal lg:text-heading-2">Pricing</h1>
      </div>
    </div>
  </section>

  <section class="relative pb-20 md:pb-[100px] lg:pb-[150px] xl:pb-[200px] pt-20px]">
    <div class="main-container flex flex-col gap-[70px]">
      <div class="flex flex-col items-center text-center">
        <h2 data-ns-animate data-delay="0.3" class="max-w-[650px] mx-auto mb-8">
          Select the pricing plan that best suits your needs.
        </h2>


      </div>
      <div class="relative">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center gap-8">
          <!-- Price Card 1 -->
          <div
            data-ns-animate
            data-delay="0.3"
            data-instant
            class="bg-background-3 dark:bg-background-5 flex-1 p-8 rounded-[20px] max-lg:w-full"
          >
            <h3 class="mb-2 font-normal text-heading-5">Free</h3>
            <p class="mb-6 max-w-[250px]">
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
              class="btn btn-md btn-white dark:btn-white-dark hover:btn-secondary dark:hover:btn-accent w-full block text-center mb-8 before:content-none first-letter:uppercase"
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
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-white dark:fill-background-9"
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
                    class="fill-white dark:fill-background-9"
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
          <!-- Price Card 2 -->
          <div
            data-ns-animate
            data-delay="0.4"
            data-instant
            class="p-2.5 rounded-[20px] flex-1 bg-[url('./images/price-bg.png')] bg-no-repeat bg-center bg-cover max-lg:w-full"
          >
            <div class="bg-white dark:bg-background-8 p-8 rounded-[12px]">
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
                class="btn btn-md btn-secondary dark:btn-accent hover:btn-primary w-full block mb-8 before:content-none first-letter:uppercase"
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
                      class="fill-white dark:fill-background-9"
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
                      class="fill-white dark:fill-background-9"
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
          <!-- Price Card 3 -->
          <div
            data-ns-animate
            data-delay="0.5"
            data-instant
            class="bg-background-3 dark:bg-background-5 flex-1 p-8 rounded-[20px] max-lg:w-full"
          >
            <h3 class="mb-2 font-normal text-heading-5">Enhanced</h3>
            <p class="mb-6 max-w-[250px] text-secondary/60 dark:text-accent/60">
              For individuals and small teams with unlimited trial access.
            </p>
            <div class="price-month mb-7">
              <h4 class="text-heading-4 font-normal">$<span>4800.00</span></h4>
              <p class="text-secondary dark:text-accent">Per Month</p>
            </div>
            <div class="price-year mb-7">
              <h4 class="text-heading-4 font-normal">$<span>5800.00</span></h4>
              <p class="text-secondary dark:text-accent">Per Year</p>
            </div>
            <a
              href="./contact-us-page.html"
              class="btn btn-md btn-white dark:btn-white-dark hover:btn-secondary dark:hover:btn-accent w-full block mb-8 before:content-none first-letter:uppercase"
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

                <span class="text-secondary dark:text-accent font-normal text-tagline-1"
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
                  <rect
                    width="20"
                    height="20"
                    rx="10"
                    fill=""
                    class="fill-white dark:fill-background-9"
                  />
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
  </section>

  <section>
    <div
      data-ns-animate
      data-delay="0.2"
      class="main-container text-center rounded-4xl py-[100px] -z-0 bg-background-3 dark:bg-background-5 overflow-hidden relative"
    >
      <div
        class="absolute -top-[164%] rotate-[21deg] -left-[35%] w-full h-full -z-10 select-none pointer-events-none"
        aria-hidden="true"
      >
        <img
          src="images/gradient/gradient-6.png"
          alt="Decorative gradient background overlay"
          class="scale-[60%]"
        />
      </div>

      <!-- Customer Testimonial -->
      <article class="text-center space-y-4 pb-10">
        <!-- Customer Avatars -->
        <div
          class="flex justify-center -space-x-2.5 cursor-pointer"
          role="group"
          aria-label="Customer avatars"
        >
          <img
            class="inline-block size-[38px] rounded-full ring-2 ring-accent dark:ring-black bg-ns-yellow"
            src="images/avatar/avatar-1.png"
            alt="Customer avatar 1"
            width="38"
            height="38"
          />
          <img
            class="inline-block size-[38px] rounded-full ring-2 ring-accent dark:ring-black bg-ns-red"
            src="images/avatar/avatar-2.png"
            alt="Customer avatar 2"
            width="38"
            height="38"
          />
          <img
            class="inline-block size-[38px] rounded-full relative z-0 ring-2 ring-accent dark:ring-black bg-ns-green"
            src="images/avatar/avatar-3.png"
            alt="Customer avatar 3"
            width="38"
            height="38"
          />
          <div
            class="inline-flex items-center relative z-10 justify-center size-[38px] bg-ns-cyan rounded-full ring-2 ring-accent dark:ring-black text-secondary/80 dark:text-accent/80 text-tagline-3 font-medium"
          >
            99+
          </div>
        </div>

        <!-- Trust Metrics -->
        <div>
          <p class="text-tagline-2 text-secondary dark:text-accent font-medium">Tushed by 20k+</p>
          <p class="text-tagline-3">Customers Across the Globe</p>
        </div>
      </article>

      <!-- Client Logos -->
      <div class="max-w-[1130px] mx-auto relative">
        <div
          class="absolute left-0 top-5 h-full w-[7%] bg-gradient-to-r from-background-3 to-transparent dark:from-background-5 z-40"
        ></div>
        <div
          class="absolute right-0 top-5 h-full w-[7%] bg-gradient-to-l from-background-3 to-transparent dark:from-background-5 z-40"
        ></div>

        <div class="logos-marquee-container">
          <div
            class="flex items-center justify-center border-t border-secondary/10 dark:border-accent/10 pt-10 gap-8"
            role="group"
          >
            <figure class="min-w-[140px] md:min-w-[201px] ml-8">
              <img
                src="./images/icons/client-logo-6.svg"
                alt="Client company logo 1"
                class="lg:w-auto inline-block dark:hidden"
                width="120"
                height="40"
              />

              <img
                src="./images/icons/client-logo-6-dark.svg"
                alt="Client company logo 1"
                class="lg:w-auto hidden dark:block"
                width="120"
                height="40"
              />
            </figure>
            <figure class="min-w-[140px] md:min-w-[201px]">
              <img
                src="./images/icons/client-logo-7.svg"
                alt="Client company logo 2"
                class="lg:w-auto inline-block dark:hidden"
                width="120"
                height="40"
              />
              <img
                src="./images/icons/client-logo-7-dark.svg"
                alt="Client company logo 2"
                class="lg:w-auto hidden dark:block"
                width="120"
                height="40"
              />
            </figure>
            <figure class="min-w-[140px] md:min-w-[201px]">
              <img
                src="./images/icons/client-logo-8.svg"
                alt="Client company logo 3"
                class="lg:w-auto inline-block dark:hidden"
                width="120"
                height="40"
              />
              <img
                src="./images/icons/client-logo-8-dark.svg"
                alt="Client company logo 3"
                class="lg:w-auto hidden dark:block"
                width="120"
                height="40"
              />
            </figure>
            <figure class="min-w-[140px] md:min-w-[201px]">
              <img
                src="./images/icons/client-logo-9.svg"
                alt="Client company logo 4"
                class="lg:w-auto inline-block dark:hidden"
                width="120"
                height="40"
              />
              <img
                src="./images/icons/client-logo-9-dark.svg"
                alt="Client company logo 4"
                class="lg:w-auto hidden dark:block"
                width="120"
                height="40"
              />
            </figure>
            <figure class="min-w-[140px] md:min-w-[201px]">
              <img
                src="./images/icons/client-logo-10.svg"
                alt="Client company logo 5"
                class="lg:w-auto inline-block dark:hidden"
                width="120"
                height="40"
              />
              <img
                src="./images/icons/client-logo-10-dark.svg"
                alt="Client company logo 5"
                class="lg:w-auto hidden dark:block"
                width="120"
                height="40"
              />
            </figure>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-[50px] md:py-20 lg:py-28 dark:bg-background-5 bg-background-1" aria-label="Use Case Overview">
    <div class="main-container">
      <div class="flex items-center flex-col lg:flex-row justify-between">
        <div
          class="xl:max-w-[650px] lg:max-w-[476px] max-[400px]:max-w-[300px] w-full space-y-5 text-center lg:text-left"
        >
          <span data-ns-animate data-delay="0.3" class="badge badge-green badge-yellow-v2"
            >Get started</span
          >
          <div class="space-y-3">
            <h2
              data-ns-animate
              data-delay="0.4"
              class="text-secondary dark:text-accent text-heading-5 sm:text-heading-4 lg:text-heading-2"
            >
              Build a complete website using the assistance
              <span class="text-primary-500 hidden">{=$span-text}</span>
            </h2>
            <p data-ns-animate data-delay="0.5">Start your free trial today and see your ideas come to life easily and creatively.</p>
          </div>
        </div>

        <div
          class="lg:basis-[466px] space-y-6 md:ml-0 xl:ml-[100px] pt-[40px] lg:pt-[67px] w-full sm:w-[80%] md:w-[60%]"
        >
          <form
            data-ns-animate
            data-delay="0.6"
            action="#"
            method="post"
            class="flex items-center flex-col gap-5 sm:flex-row justify-start lg:gap-3"
          >
            <input
              type="email"
              name="email"
              id="userEmail-cta-v1"
              placeholder="Enter your email"
              required
              class="px-[18px] shadow-1 h-12 py-3 placeholder:text-secondary/50 rounded-full border border-stroke-1 lg:max-w-[340px] md:w-[71%] w-full max-[376px]:w-full dark:border-stroke-7 dark:placeholder:text-accent/60 focus:outline-none focus:border-primary-600 dark:focus:border-primary-400 dark:text-accent placeholder:font-normal font-normal"
            />

            <button
              type="submit"
              class="btn btn-md btn-primary h-12 w-full sm:w-[28%] lg:w-auto btn-primary hover:btn-secondary dark:hover:btn-accent"
            >
              <span>Get started</span>
            </button>
          </form>
          <ul
            class="flex flex-row items-center justify-center gap-x-4 sm:gap-x-6 sm:gap-y-0 gap-y-5 lg:justify-start"
          >
            <li data-ns-animate data-delay="0.7" class="flex items-center justify-center gap-2">
              <span
                class="size-[18px] bg-secondary dark:bg-accent rounded-full flex items-center justify-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="10"
                  height="7"
                  viewBox="0 0 10 7"
                  fill="none"
                  aria-hidden="true"
                  class="fill-white dark:fill-secondary"
                >
                  <path
                    d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                  />
                </svg>
              </span>
              <p class="text-tagline-3 sm:text-tagline-2">No credit card required</p>
            </li>
            <li data-ns-animate data-delay="0.8" class="flex items-center justify-center gap-2">
              <span
                class="size-[18px] bg-secondary dark:bg-accent rounded-full flex items-center justify-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="10"
                  height="7"
                  viewBox="0 0 10 7"
                  fill="none"
                  aria-hidden="true"
                  class="fill-white dark:fill-secondary"
                >
                  <path
                    d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                  />
                </svg>
              </span>
              <p class="text-tagline-3 sm:text-tagline-2">14-Day free trial</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection