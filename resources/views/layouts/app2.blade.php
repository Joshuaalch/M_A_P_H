
<nav class="bg-white shadow-lg">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex justify-between items-center py-4">
      <!-- Logo -->
      <a href="/" class="flex items-center">
        <span class="font-semibold text-gray-800 text-xl">Mi App</span>
      </a>

      <!-- Menú de navegación -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="/lobby" class="text-gray-600 hover:text-blue-500 font-semibold">
          Lobby
        </a>
        <a href="/messages" class="text-gray-600 hover:text-blue-500 font-semibold">
          Mensajes
        </a>
        <a href="/appointments" class="text-gray-600 hover:text-blue-500 font-semibold">
          Citas
        </a>
      </div>

      <!-- Menú de perfil -->
      <div class="relative">
        <!-- Círculo del perfil -->
        <button
          id="profile-menu-button"
          class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full focus:outline-none"
        >
          {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </button>

        <!-- Menú desplegable -->
        <div
          id="profile-menu"
          class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2"
        >
          <a
            href="{{ route('profile.edit') }}"
            class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600"
          >
            Editar Perfil
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600"
            >
              Cerrar Sesión
            </button>
          </form>
          <button
            id="close-menu-button"
            class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600"
          >
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Scripts para manejar el menú desplegable -->
@section('scripts')
@stack('styles')
<script>
  // Obtener elementos del DOM
  const profileMenuButton = document.getElementById('profile-menu-button');
  const profileMenu = document.getElementById('profile-menu');
  const closeMenuButton = document.getElementById('close-menu-button');

  // Mostrar/ocultar el menú al hacer clic en el círculo del perfil
  profileMenuButton.addEventListener('click', () => {
    profileMenu.classList.toggle('hidden');
  });

  // Ocultar el menú al hacer clic en "Cerrar"
  closeMenuButton.addEventListener('click', () => {
    profileMenu.classList.add('hidden');
  });

  // Ocultar el menú al hacer clic fuera de él
  document.addEventListener('click', (event) => {
    if (
      !profileMenu.contains(event.target) &&
      !profileMenuButton.contains(event.target)
    ) {
      profileMenu.classList.add('hidden');
    }
  });
</script>
