<nav x-data="{ isOpen: false }" class="bg-greek-blue text-white fixed w-full z-50 border-b-2 border-greek-gold">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center ml-3 text-2xl font-diogenes">
                Cervejaria Dionisio
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="#home" class="text-greek-gold hover:text-white px-3 py-2">Início</a>
                    <a href="#beers" class="text-greek-gold hover:text-white px-3 py-2">Cervejas</a>
                    <a href="#about" class="text-greek-gold hover:text-white px-3 py-2">História</a>
                    <a href="#contact" class="text-greek-gold hover:text-white px-3 py-2">Contato</a>
                </div>
            </div>

            <div class="md:hidden relative">
                <button
                    @click="isOpen = !isOpen"
                    class="inline-flex items-center justify-center p-2 text-greek-gold hover:text-white"
                >
                    <template x-if="isOpen">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                    <template x-if="!isOpen">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </template>
                </button>
            </div>
        </div>
    </div>

    <div
        x-show="isOpen"
        x-transition:enter="transition-all duration-300 ease-out"
        x-transition:enter-start="max-h-0 opacity-0"
        x-transition:enter-end="max-h-[300px] opacity-100"
        x-transition:leave="transition-all duration-300 ease-in"
        x-transition:leave-start="max-h-[300px] opacity-100"
        x-transition:leave-end="max-h-0 opacity-0"
        class="absolute top-full left-0 w-full bg-greek-blue border-t border-greek-gold shadow-lg overflow-hidden md:hidden"
    >
        <div class="px-4 py-2 space-y-1">
            <a href="#home" class="block text-greek-gold hover:text-white px-3 py-2 font-trajan">Início</a>
            <a href="#beers" class="block text-greek-gold hover:text-white px-3 py-2 font-trajan">Cervejas</a>
            <a href="#about" class="block text-greek-gold hover:text-white px-3 py-2 font-trajan">História</a>
            <a href="#contact" class="block text-greek-gold hover:text-white px-3 py-2 font-trajan">Contato</a>
        </div>
    </div>

</nav>
