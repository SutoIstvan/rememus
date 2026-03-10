@extends('layouts.app')

@section('content')
<div class="w-full bg-white pt-[100px]" style="box-shadow:0 2px 40px rgba(0,0,0,0.07);">
    <div class="grid grid-cols-1 md:grid-cols-2">

      <!-- LEFT: Gallery -->
      <div class="bg-stone-50">
        <div class="aspect-square overflow-hidden">
          <img id="main-img"
            src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-01.jpg"
            alt="Angled view"
            class="w-full h-full object-cover img-fade" />
        </div>
        <div class="flex gap-2 p-4 bg-white border-t border-stone-100">
          <button onclick="switchImage(this, 0)"
            class="thumb active flex-1 aspect-square overflow-hidden"
            data-src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-01.jpg">
            <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-01.jpg" class="w-full h-full object-cover" alt="Angled"/>
          </button>
          <button onclick="switchImage(this, 1)"
            class="thumb opacity-50 flex-1 aspect-square overflow-hidden"
            data-src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-02.jpg">
            <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-02.jpg" class="w-full h-full object-cover" alt="Front"/>
          </button>
          <button onclick="switchImage(this, 2)"
            class="thumb opacity-50 flex-1 aspect-square overflow-hidden"
            data-src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-03.jpg">
            <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-03.jpg" class="w-full h-full object-cover" alt="Back"/>
          </button>
          <button onclick="switchImage(this, 3)"
            class="thumb opacity-50 flex-1 aspect-square overflow-hidden"
            data-src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-04.jpg">
            <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-03-product-04.jpg" class="w-full h-full object-cover" alt="Open"/>
          </button>
        </div>
      </div>

      <!-- RIGHT: Info -->
      <div class="flex flex-col p-8 lg:p-12">

        <!-- Header -->
        <div class="mb-6">
          <p class="text-xs tracking-widest uppercase text-stone-400 mb-3">Canvas Collection</p>
          <h1 class="serif text-4xl font-light text-stone-900 leading-tight mb-3">Zip Tote Basket</h1>
          <div class="flex items-center justify-between mt-3">
            <!-- Stars -->
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4 text-stone-800" viewBox="0 0 20 20" fill="currentColor"><path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"/></svg>
              <svg class="w-4 h-4 text-stone-800" viewBox="0 0 20 20" fill="currentColor"><path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"/></svg>
              <svg class="w-4 h-4 text-stone-800" viewBox="0 0 20 20" fill="currentColor"><path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"/></svg>
              <svg class="w-4 h-4 text-stone-800" viewBox="0 0 20 20" fill="currentColor"><path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"/></svg>
              <svg class="w-4 h-4 text-stone-200" viewBox="0 0 20 20" fill="currentColor"><path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"/></svg>
              <span class="ml-2 text-xs text-stone-400 tracking-widest uppercase">4 / 5</span>
            </div>
            <span class="serif text-3xl font-light text-stone-800">$140</span>
          </div>
        </div>

        <div class="w-8 h-px bg-stone-200 mb-6"></div>

        <!-- Description -->
        <p class="text-sm text-stone-500 leading-relaxed mb-8">
          The Zip Tote Basket is the perfect midpoint between shopping tote and comfy backpack.
          With convertible straps, you can hand carry, shoulder sling, or backpack this convenient
          and spacious bag. The zip top and durable canvas construction keeps your goods protected for all-day use.
        </p>

        <!-- Color -->
        <div class="mb-8">
          <p class="text-xs tracking-widest uppercase text-stone-400 mb-3">
            Color — <span id="color-label" class="text-stone-700">Washed Black</span>
          </p>
          <div class="flex gap-3">
            <button onclick="selectColor(this, 'Washed Black')"
              class="color-btn active w-7 h-7 rounded-full"
              style="background:#2c2c2c;"></button>
            <button onclick="selectColor(this, 'White')"
              class="color-btn w-7 h-7 rounded-full"
              style="background:#f5f5f0; border:1px solid #d6d3d1;"></button>
            <button onclick="selectColor(this, 'Washed Gray')"
              class="color-btn w-7 h-7 rounded-full"
              style="background:#9e9e99;"></button>
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 mb-8">
          <button id="add-btn" onclick="addToBag()"
            class="add-btn flex-1 py-3.5 text-white text-xs tracking-widest uppercase"
            style="background:#1c1917; letter-spacing:0.2em;">
            Add to bag
          </button>
          <button id="like-btn" onclick="toggleLike()"
            class="like-btn w-12 h-12 flex items-center justify-center border border-stone-200">
            <svg id="like-icon" class="w-5 h-5" viewBox="0 0 24 24"
              fill="none" stroke="#a8a29e" stroke-width="1.5">
              <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>

        <!-- Accordions -->
        <div class="border-t border-stone-100 mt-auto">

          <div class="border-b border-stone-100">
            <button onclick="toggleAcc(this)" class="w-full flex items-center justify-between py-4 text-left group">
              <span class="text-xs tracking-widest uppercase text-stone-500 group-hover:text-stone-900 transition-colors">Features</span>
              <svg class="acc-icon w-4 h-4 text-stone-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="accordion-body">
              <ul class="space-y-2">
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Multiple strap configurations</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Spacious interior with top zip</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Leather handle and tabs</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Interior dividers</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Stainless strap loops</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Double stitched construction</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Water-resistant</li>
              </ul>
            </div>
          </div>

          <div class="border-b border-stone-100">
            <button onclick="toggleAcc(this)" class="w-full flex items-center justify-between py-4 text-left group">
              <span class="text-xs tracking-widest uppercase text-stone-500 group-hover:text-stone-900 transition-colors">Care</span>
              <svg class="acc-icon w-4 h-4 text-stone-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="accordion-body">
              <ul class="space-y-2">
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Spot clean as needed</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Hand wash with mild soap</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Machine wash interior dividers</li>
                <li class="flex items-start gap-2 text-sm text-stone-500"><span class="mt-1.5 w-1 h-1 rounded-full bg-stone-300 shrink-0"></span>Treat handle and tabs with leather conditioner</li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
</div>

<script>
    // Gallery
    function switchImage(btn, idx) {
      const mainImg = document.getElementById('main-img');
      mainImg.src = btn.dataset.src;
      mainImg.classList.remove('img-fade');
      void mainImg.offsetWidth;
      mainImg.classList.add('img-fade');
      document.querySelectorAll('.thumb').forEach(t => {
        t.classList.remove('active');
        t.classList.add('opacity-50');
      });
      btn.classList.add('active');
      btn.classList.remove('opacity-50');
    }

    // Colors
    function selectColor(btn, label) {
      document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById('color-label').textContent = label;
    }

    // Add to bag
    function addToBag() {
      const btn = document.getElementById('add-btn');
      btn.textContent = '✓ Added';
      btn.style.background = '#78716c';
      setTimeout(() => {
        btn.textContent = 'Add to bag';
        btn.style.background = '#1c1917';
      }, 1800);
    }

    // Like
    let liked = false;
    function toggleLike() {
      liked = !liked;
      const icon = document.getElementById('like-icon');
      const btn = document.getElementById('like-btn');
      if (liked) {
        icon.setAttribute('fill', '#1c1917');
        icon.setAttribute('stroke', '#1c1917');
        btn.style.borderColor = '#1c1917';
      } else {
        icon.setAttribute('fill', 'none');
        icon.setAttribute('stroke', '#a8a29e');
        btn.style.borderColor = '#e7e5e4';
      }
    }

    // Accordion
    function toggleAcc(btn) {
      const body = btn.nextElementSibling;
      const icon = btn.querySelector('.acc-icon');
      const isOpen = body.classList.contains('open');
      body.classList.toggle('open', !isOpen);
      icon.classList.toggle('open', !isOpen);
    }
</script>

@endsection