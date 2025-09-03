<template>
  <main class="grid h-dvh place-items-center bg-gray-100 px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center">
      <p class="text-base font-semibold text-orange-500">404</p>
      <h1 class="mt-4 text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Page not found</h1>
      <p class="mt-6 text-lg font-medium text-gray-700 sm:text-xl/8">Sorry, we couldn’t find the page you’re looking for.</p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <RouterLink
          to="/"
          class="rounded-md bg-orange-500 px-3.5 py-2.5 text-sm font-semibold text-black shadow hover:bg-orange-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500"
        >
          Go back home
        </RouterLink>
        <a href="#" class="text-sm font-semibold text-orange-500">Contact support <span aria-hidden="true">&rarr;</span></a>
      </div>
    </div>
  </main>
</template>
