<section class="py-24 bg-greek-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-trajan text-greek-blue mb-4">Visite-nos</h2>
            <div class="w-24 h-1 bg-greek-gold mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            <div class="bg-white p-12 border-4 border-greek-blue">
                <h3 class="text-2xl font-trajan text-greek-blue mb-8">Informações</h3>

                <div class="space-y-6">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-greek-gold mr-4"></i>
                        <span class="font-serif">Rua da Cervejaria, 123 - Sua Cidade, Estado</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-phone text-greek-gold mr-4"></i>
                        <span class="font-serif">(11) 1234-5678</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-envelope text-greek-gold mr-4"></i>
                        <span class="font-serif">contato@cervejariadionisio.com.br</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-clock text-greek-gold mr-4"></i>
                        <div class="font-serif">
                            <p>Segunda - Quinta: 14h - 22h</p>
                            <p>Sexta - Domingo: 12h - 00h</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 border-4 border-greek-blue">
                <h3 class="text-2xl font-trajan text-greek-blue mb-8">Mensagem</h3>

                <form method="POST" action="" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-greek-blue font-serif mb-2">Nome</label>
                        <input type="text" name="name" class="w-full px-4 py-3 border-2 border-greek-gold bg-greek-cream focus:outline-none focus:border-greek-blue font-serif" required>
                    </div>

                    <div>
                        <label class="block text-greek-blue font-serif mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-3 border-2 border-greek-gold bg-greek-cream focus:outline-none focus:border-greek-blue font-serif" required>
                    </div>

                    <div>
                        <label class="block text-greek-blue font-serif mb-2">Mensagem</label>
                        <textarea name="message" rows="4" class="w-full px-4 py-3 border-2 border-greek-gold bg-greek-cream focus:outline-none focus:border-greek-blue font-serif" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-greek-blue text-white px-8 py-4 font-trajan hover:bg-opacity-90 transition-colors border-2 border-greek-gold">
                        Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
