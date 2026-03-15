@extends('layouts.app')

@section('content')
<main>
<section class="xl:pt-[170px] pt-[140px] xl:pb-28 lg:pb-20 pb-16">
  <div class="main-container">
    <div class="space-y-4 text-center lg:text-left">
      <h1 data-ns-animate data-delay="0.1" class="font-normal">Создание страницы</h1>
      <p
        data-ns-animate
        data-delay="0.2"
        class="lg:max-w-full sm:max-w-[550px] max-w-full mx-auto lg:mx-0"
      >
        Подробное руководство по каждому шагу создания
        <br class="hidden lg:block" />
        мемориальной страницы для ваших близких.
      </p>
    </div>
  </div>
</section>

      <section class="py-16 lg:py-20 xl:py-28">
  <div class="main-container">
    <div class="grid grid-cols-12 items-start gap-y-6 lg:gap-x-6 lg:gap-y-0">
      <div
        data-ns-animate
        data-delay="0.1"
        class="sticky top-28 col-span-12 space-y-8 lg:col-span-3"
      >
        <div class="relative z-0 space-y-3">
          <p class="text-tagline-2 text-secondary dark:text-accent font-medium">Оглавление</p>
          <div class="relative z-0 space-y-1">
            <a
              href="#step-1"
              data-month-link="step-1"
              class="month-link group text-secondary text-tagline-1 dark:text-accent bg-background-12 dark:!bg-background-6 relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">First step</span>
            </a>
            <a
              href="#step-2"
              data-month-link="step-2"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Главная информация</span>
            </a>
            <a
              href="#step-3"
              data-month-link="step-3"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Фотогалерея</span>
            </a>
            <a
              href="#step-4"
              data-month-link="step-4"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Семейное дерево</span>
            </a>
            <a
              href="#step-5"
              data-month-link="step-5"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Временная шкала</span>
            </a>
            <a
              href="#step-6"
              data-month-link="step-6"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Память</span>
            </a>
            <a
              href="#step-7"
              data-month-link="step-7"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Место захоронения</span>
            </a>
            <a
              href="#step-8"
              data-month-link="step-8"
              class="month-link group text-secondary text-tagline-1 dark:text-accent relative z-0 flex items-center justify-start rounded-[10px] px-6 py-3.5 font-normal"
            >
              <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-background-3 dark:bg-background-7 opacity-0 group-hover:opacity-100 rounded-[10px] z-0 transition-all duration-400 group-hover:bg-background-12 dark:group-hover:!bg-background-6"
              ></div>

              <span class="relative z-10">Слова памяти</span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-span-12 space-y-2 lg:col-span-9">
                <div
          id="step-1"
          data-month="step-1"
          data-ns-animate
          data-delay="0.1"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              First Steps
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >Getting Started</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Before you begin</p>
            <p>Follow these simple steps to activate your memorial page and attach the memorial plaque.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Что можно заполнить:
            </p>
            <ul class="mt-4 mb-10.5 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Scan the QR code.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Log in to your account or register.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Enter all details and upload a photo.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Clean the monument with the included alcohol wipe.
                </p>
              </li>

                            <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Attach the code to the monument.
                </p>
              </li>
            </ul>


          <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Scan the QR code
                  </h3>
                  <p>Отсканируйте уникальный QR-код с помощью камеры вашего смартфона, чтобы начать процесс настройки мемориальной страницы.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Log in or register
                  </h3>
                  <p class="md:max-w-[272px]">
                    Войдите в свой аккаунт или зарегистрируйтесь для продолжения настройки.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Enter details
                  </h3>
                  <p>Заполните всю необходимую информацию о человеке и загрузите фотографию профиля.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Clean the monument
                  </h3>
                  <p class="max-w-[272px]">Очистите поверхность памятника с помощью прилагаемой спиртовой салфетки для надежной фиксации таблички.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Attach the code</h3>
                  <p class="">
                    Прикрепите код к памятнику. После этого мемориальная страница будет навсегда связана с выбранным местом.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>

        <div
          id="step-2"
          data-month="step-2"
          data-ns-animate
          data-delay="0.1"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              1. Главная информация
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >Основа профиля</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Первые шаги</p>
            <p>Заполните базовые данные о человеке, чтобы создать основу мемориальной страницы.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Что можно заполнить:
            </p>
            <ul class="mt-4 mb-10.5 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Выбор фото профиля человека.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Ввод имени.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Выбор даты рождения и даты смерти.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Ввод места рождения.
                </p>
              </li>

                            <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Выбор фотографии бекграунда (обложки) из предложенных существующих вариантов или загрузка своей собственной картинки.
                </p>
              </li>

                            <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Кнока видимости страницы. Страница может быть видна только по qr code, по ссылке. Не видна на сайте в списке мемориальных страниц и не берет участия в поиске такие как google, bing.
                </p>
              </li>
            </ul>


          <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Главная информация
                  </h3>
                  <p>Ввод имени. Выбор даты рождения и даты смерти. Ввод места рождения.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Фото профиля
                  </h3>
                  <p class="md:max-w-[272px]">
                    Выбор фото профиля человека
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Видимость
                  </h3>
                  <p>Страница может быть видна только qe code</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Выбор фотографии бекграунда (обложки) 
                  </h3>
                  <p class="max-w-[272px]">Выбор фотографии бекграунда (обложки) из предложенных существующих вариантов или загрузка своей собственной картинки.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Загрузка картинки для обложки</h3>
                  <p class="">
                    Загрузка своей собственной картинки для использования в качестве обложки страницы.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
        <div
          id="step-3"
          data-month="step-3"
          data-ns-animate
          data-delay="0.2"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              2. Фотогалерея
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >Медиа</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Память в снимках</p>
            <p>Загружайте фотографии, чтобы сохранить визуальные воспоминания.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Возможности
            </p>
            <ul class="mt-4 mb-6 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">Можно загрузить до 12 фотографий в галерею памяти.</p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Встроенный инструмент переворота фото, если снимок загрузился вверх ногами.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Можно менять порядок фото перетягивая фото в нужное место.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  В будущем планируется добавить возможность ретуш фото с помощью нейросети.
                </p>
              </li>
            </ul>


          <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Загрузка медиа
                  </h3>
                  <p>Сохраните важные моменты, загрузив до 50 фотографий или добавив видеоролики в медиагалерею.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Управление фото
                  </h3>
                  <p class="md:max-w-[272px]">
                    Удобный интерфейс для добавления и удаления фотографий.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Сортировка
                  </h3>
                  <p>Можно легко менять порядок фото, перетягивая их в нужное место.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Обработка с помощью ИИ
                  </h3>
                  <p class="max-w-[272px]">В будущем мы добавим интеграцию с нейросетью для автоматической ретуши и восстановления качества старых фото.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Просмотр галереи</h3>
                  <p class="">
                    Полноэкранный просмотр фотографий и видео с удобной навигацией для посетителей мемориальной страницы.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>
          
          </div>
        </div>
        <div
          id="step-4"
          data-month="step-4"
          data-ns-animate
          data-delay="0.3"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              3. Семейное дерево
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >Родственные связи</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Связь поколений</p>
            <p>Укажите членов семьи, чтобы воссоздать историю рода.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Опции семейного дерева:
            </p>
            <ul class="mt-4 mb-6 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Кого можно добавить: бабушек, дедушек, маму, папу, сожителя (жену/мужа), братьев, сестер, детей.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  К каждому родственнику можно загрузить фото (аватарку).
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Если у родственника уже есть своя мемориальная страница на сайте, можно указать её код для связи профилей.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Блок можно отключить, если вы не хотите отображать семейное дерево.
                </p>
              </li>
            </ul>

          <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Ключевые события
                  </h3>
                  <p>Добавляйте значимые события, достижения и переломные моменты из жизни человека, создавая подробную биографическую ленту.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Хронология дат
                  </h3>
                  <p class="md:max-w-[272px]">
                    События автоматически выстраиваются в хронологическом порядке в зависимости от указанных дат.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Описание событий
                  </h3>
                  <p>К каждой дате можно добавить подробный текстовый рассказ, чтобы сохранить историю для потомков.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Медиа-поддержка
                  </h3>
                  <p class="max-w-[272px]">Прикрепляйте к каждому событию на шкале исторические фотографии и видеозаписи тех лет.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Наглядный дизайн</h3>
                  <p class="">
                    Шкала оформлена в виде интерактивного вертикального пути, который позволяет посетителям путешествовать сквозь время.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
        <div
          id="step-5"
          data-month="step-5"
          data-ns-animate
          data-delay="0.1"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              4. Временная шкала
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >События жизни</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Хронология</p>
            <p>Добавляйте важные вехи из жизни человека: учеба, работа, свадьба, рождение детей и другие значимые события.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Функционал:
            </p>
            <ul class="mt-4 mb-10.5 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Возможность создавать, редактировать и удалять любые события.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  К каждому событию можно прикрепить фотографию.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Указание точных дат начала и окончания события.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Блок легко отключается, если его отображение на странице не требуется.
                </p>
              </li>
            </ul>

                      <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Черты характера
                  </h3>
                  <p>Опишите уникальные черты характера человека, чтобы посетители страницы могли лучше понять, каким он был в жизни.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Привычки и увлечения
                  </h3>
                  <p class="md:max-w-[272px]">
                    Добавьте информацию о любимых занятиях, хобби и повседневных привычках.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Любимые цитаты
                  </h3>
                  <p>Сохраните крылатые фразы, любимые выражения или жизненное кредо ушедшего человека.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Воспоминания близких
                  </h3>
                  <p class="max-w-[272px]">Коллекция коротких историй и теплых слов от друзей и членов семьи в едином блоке.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Визуальный образ</h3>
                  <p class="">
                    Характеристики отображаются в виде удобных тегов и карточек, делая раздел «Память» живым и эмоциональным.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
        <div
          id="step-6"
          data-month="step-6"
          data-ns-animate
          data-delay="0.2"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              5. Память (Характеристики)
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >AI Генерация</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Интеллектуальная биография</p>
            <p>Укажите черты характера и интересы. На их основе искусственный интеллект сможет написать красивую биографию.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Особенности раздела:
            </p>
            <ul class="mt-4 mb-6 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">Добавьте заметки о хобби, привычках, любимых книгах, жизненных принципах и других примечаниях.</p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Нажмите кнопку &laquo;Generate Biography & Motto&raquo;, и AI сформирует детальный текст биографии и короткий девиз на основе введенных характеристик. Генерацию можно деактивировать.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Все сгенерированные тексты можно отредактировать самостоятельно перед публикацией. Так же весь блок можно отключить для отображения.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Expanded webhook retry policy and dead-letter queue.
                </p>
              </li>
            </ul>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Блок можно отключить, если вы не хотите его использовать.
                </p>
              </li>
            </ul>

          <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Точные координаты
                  </h3>
                  <p>Отметьте точное место захоронения на интерактивной карте, чтобы его было легко найти даже на большом кладбище.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Построение маршрута
                  </h3>
                  <p class="md:max-w-[272px]">
                    Интеграция с картами позволяет посетителям проложить удобный маршрут прямо до могилы с любого устройства.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Фотография памятника
                  </h3>
                  <p>Добавьте актуальное фото места захоронения, чтобы близкие могли оценить его состояние издалека.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Сектор и номер участка
                  </h3>
                  <p class="max-w-[272px]">Возможность указать текстовое описание: название кладбища, номер сектора, ряда и самого места.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Глобальная доступность</h3>
                  <p class="">
                    Полезно для родственников и друзей, которые живут в других городах или странах и не могут посещать место лично.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
        <div
          id="step-7"
          data-month="step-7"
          data-ns-animate
          data-delay="0.3"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              6. Место захоронения
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >Навигация</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Как найти</p>
            <p>Укажите детали места захоронения, чтобы близким было легче найти памятник.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Что можно заполнить:
            </p>
            <ul class="mt-4 mb-6 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Укажите адрес кладбища, номер сектора (ряда) и номер места.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Добавьте точные GPS-координаты для удобной навигации на картах.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Загрузите фотографию памятника с включенными геоданными. Система автоматически извлечет координаты из фото. На странице есть встроенная инструкция, как включить геометки на iOS и Android.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Блок легко отключается, если вы не хотите разглашать эту информацию.
                </p>
              </li>
            </ul>

          <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Книга памяти
                  </h3>
                  <p>Каждый посетитель страницы может оставить свои искренние слова соболезнования и поддержки в специальном разделе.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Виртуальные свечи
                  </h3>
                  <p class="md:max-w-[272px]">
                    Возможность зажечь символическую свечу памяти в знак уважения к ушедшему.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Совместные истории
                  </h3>
                  <p>Друзья и коллеги могут поделиться уникальными историями из жизни, создавая объемный портрет человека.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Прикрепление фото
                  </h3>
                  <p class="max-w-[272px]">К своему сообщению можно добавить совместную фотографию, чтобы лучше передать атмосферу момента.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Модерация</h3>
                  <p class="">
                    Журнал памяти находится под вашим контролем — вы можете модерировать и удалять неуместные сообщения.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
        <div
          id="step-8"
          data-month="step-8"
          data-ns-animate
          data-delay="0.1"
          class="month-card bg-background-2 dark:bg-background-6 border-stroke-1 dark:border-background-7 rounded-[20px] border p-5 lg:p-8"
        >
          <div class="mb-14 space-y-4">
            <h3>
              7. Слова памяти
            </h3>
            <span
              class="bg-background-12 dark:bg-background-7 border-stroke-1 dark:border-background-7 text-tagline-1 text-secondary dark:text-accent inline-flex rounded-full border px-5 py-2 font-normal"
              >Для посетителей</span
            >
          </div>
          <div>
            <p class="text-heading-5 text-secondary dark:text-accent mb-3 font-normal">Комментарии</p>
            <p>Управление разделом, где посетители могут оставлять свои воспоминания и слова поддержки.</p>
            <p class="text-heading-6 text-secondary dark:text-accent mt-6 mb-4 font-normal">
              Функции раздела:
            </p>
            <ul class="mt-4 mb-10.5 space-y-3">
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Любой гость страницы может оставить свои слова соболезнования в специальном блоке.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Все комментарии подлежат модерации. Вы можете просматривать, одобрять для публикации или удалять записи.
                </p>
              </li>
              <li class="flex items-center gap-x-2">
                <span
                  class="bg-secondary dark:bg-accent flex size-5 shrink-0 items-center justify-center rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    fill="none"
                  >
                    <path
                      d="M4.31661 6.75605L9.74905 1.42144C10.0836 1.0959 10.0836 0.569702 9.74905 0.244158C9.41446 -0.081386 8.87363 -0.081386 8.53904 0.244158L3.7116 4.99012L1.46096 2.78807C1.12636 2.46253 0.585538 2.46253 0.250945 2.78807C-0.0836483 3.11362 -0.0836483 3.63982 0.250945 3.96536L3.1066 6.75605C3.27347 6.91841 3.49253 7 3.7116 7C3.93067 7 4.14974 6.91841 4.31661 6.75605Z"
                      class="fill-accent dark:fill-secondary"
                    />
                  </svg>
                </span>
                <p class="text-secondary/80 dark:text-accent/80">
                  Если вы не хотите, чтобы люди могли оставлять комментарии, этот блок можно полностью отключить в настройках.
                </p>
              </li>
            </ul>

                      <div class="grid grid-cols-12 xl:gap-8 md:gap-6 gap-y-8">
            <div data-ns-animate data-delay="0.3" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Загрузка медиа
                  </h3>
                  <p>Сохраните важные моменты, загрузив до 50 фотографий или добавив видеоролики в медиагалерею.</p>
                </div>
                <div class="bg-white dark:bg-background-6 p-4 rounded-2xl md:min-h-[226px]">
                  <figure
                    class="bg-background-2 dark:bg-background-6 rounded-xl overflow-hidden md:p-12 p-8 flex items-center justify-center"
                  >
                    <img
                      src="images/home-page-35/service-1.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-1-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.4" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Управление фото
                  </h3>
                  <p class="md:max-w-[272px]">
                    Удобный интерфейс для добавления и удаления фотографий.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.5" class="col-span-12 xl:col-span-4 md:col-span-6">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Сортировка
                  </h3>
                  <p>Можно легко менять порядок фото, перетягивая их в нужное место.</p>
                </div>
                <div>
                  <figure
                    class="rounded-2xl overflow-hidden max-h-[234px] max-w-full max-sm:relative max-sm:left-[9%]"
                  >
                    <img
                      src="images/home-page-35/service-2.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-2-dark.png"
                      alt="hexa-play"
                      class="object-cover h-full w-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.6" class="col-span-12 xl:col-span-8">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">
                    Обработка с помощью ИИ
                  </h3>
                  <p class="max-w-[272px]">В будущем мы добавим интеграцию с нейросетью для автоматической ретуши и восстановления качества старых фото.</p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px] bg-white dark:bg-background-6">
                    <img
                      src="images/home-page-35/service-4.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-4-dark.png"
                      alt="hexa-play"
                      class="w-full h-full object-cover hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
            <div data-ns-animate data-delay="0.7" class="col-span-12 xl:col-span-12">
              <div
                class="rounded-[20px] bg-background-2 dark:bg-background-5 sm:space-y-6 space-y-4 md:min-h-[408px]"
              >
                <div class="space-y-1 text-center md:text-left">
                  <h3 class="lg:text-heading-5 sm:text-heading-6 text-tagline-1">Просмотр галереи</h3>
                  <p class="">
                    Полноэкранный просмотр фотографий и видео с удобной навигацией для посетителей мемориальной страницы.
                  </p>
                </div>
                <div>
                  <figure class="rounded-2xl overflow-hidden h-[234px]">
                    <img
                      src="images/home-page-35/service-5.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full dark:hidden"
                    />
                    <img
                      src="images/home-page-35/service-5-dark.png"
                      alt="hexa-play"
                      class="object-cover w-full h-full hidden dark:block"
                    />
                  </figure>
                </div>
              </div>
            </div>
          </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
@endsection