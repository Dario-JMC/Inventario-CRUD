<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->nombre }} - Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center justify-between border-b border-gray-800 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-white">{{ $store->nombre_tienda }}</h1>
                <p class="text-sm text-gray-400">Slug: {{ $store->slug }}</p>
            </div>
            <a href="{{ route('stores.index') }}" class="px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 text-sm text-gray-200">
                ← Volver a tiendas
            </a>
        </div>

        @if (session('success'))
            <div class="p-4 rounded bg-emerald-950 border border-emerald-700 text-emerald-300 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 rounded bg-red-950 border border-red-700 text-red-300 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Agregar producto a esta tienda</h2>

            <form action="{{ route('stores.productos.store', $store) }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                @csrf

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                           class="w-full rounded bg-gray-950 border border-gray-700 px-3 py-2 text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1">Precio</label>
                    <input type="number" step="0.01" min="0" name="precio" value="{{ old('precio') }}" required
                           class="w-full rounded bg-gray-950 border border-gray-700 px-3 py-2 text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1">Stock</label>
                    <input type="number" min="0" name="stock" value="{{ old('stock', 0) }}" required
                           class="w-full rounded bg-gray-950 border border-gray-700 px-3 py-2 text-white focus:outline-none focus:border-blue-500">
                </div>

                <div class="md:col-span-4 flex items-center justify-between pt-2">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-300">
                        <input type="checkbox" name="activo" value="1" {{ old('activo', '1') ? 'checked' : '' }}
                               class="rounded bg-gray-950 border-gray-700 text-blue-600">
                        Producto activo
                    </label>

                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm">
                        Guardar producto
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Productos de la tienda ({{ $store->productos->count() }})</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 text-gray-400 text-sm">
                            <th class="py-2 px-3">Nombre</th>
                            <th class="py-2 px-3">Precio</th>
                            <th class="py-2 px-3">Stock</th>
                            <th class="py-2 px-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-sm">
                        @forelse ($store->productos as $product)
                            <tr class="hover:bg-gray-800/50">
                                <td class="py-3 px-3 font-medium text-white">{{ $product->nombre }}</td>
                                <td class="py-3 px-3 text-gray-300">${{ number_format($product->precio, 2) }}</td>
                                <td class="py-3 px-3 text-gray-300">{{ $product->stock }}</td>
                                <td class="py-3 px-3">
                                    @if ($product->activo)
                                        <span class="px-2 py-1 text-xs rounded bg-emerald-950 text-emerald-300 border border-emerald-800">Activo</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-gray-800 text-gray-400 border border-gray-700">Inactivo</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 px-3 text-center text-gray-400">
                                    Aún no hay productos registrados en esta tienda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>