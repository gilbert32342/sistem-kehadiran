<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="block py-2 px-4 text-red-500 hover:bg-gray-200">Logout</button>
</form>
