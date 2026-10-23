@extends('layouts.app')

@section('content')
<section class="bg-charcoal py-32 md:py-40">
    <article class="section-inner max-w-4xl">
        <p class="text-xs uppercase tracking-[.3em] text-gold">Dokumen layanan</p>
        <h1 class="mt-4 font-heading text-4xl text-white md:text-6xl">Kebijakan Privasi</h1>
        <p class="mt-5 text-sm text-white/40">Draf contoh — tinjau dan sesuaikan sebelum dipublikasikan.</p>
        <div class="mt-10 space-y-8 leading-8 text-white/65">
            <section><h2 class="font-heading text-2xl text-white">Informasi yang kami terima</h2><p class="mt-3">Formulir kontak dapat menyimpan nama, nomor telepon, email bila diberikan, informasi acara, lokasi, dan kebutuhan perlengkapan. Informasi ini digunakan untuk menanggapi konsultasi yang diminta.</p></section>
            <section><h2 class="font-heading text-2xl text-white">Penggunaan dan akses</h2><p class="mt-3">Data hanya dapat diakses oleh personel yang menangani komunikasi dan layanan. Kami tidak menjual data pengunjung. Tetapkan masa retensi dan prosedur penghapusan sesuai kebijakan perusahaan yang berlaku.</p></section>
            <section><h2 class="font-heading text-2xl text-white">WhatsApp dan layanan pihak ketiga</h2><p class="mt-3">Saat memilih tautan WhatsApp, Anda akan berpindah ke layanan Meta/WhatsApp yang memiliki kebijakan privasinya sendiri. Jangan mengirimkan informasi sensitif melalui formulir atau percakapan publik.</p></section>
            <section><h2 class="font-heading text-2xl text-white">Permintaan informasi</h2><p class="mt-3">Hubungi {{ $settings['email'] ?: 'alamat email resmi perusahaan' }} untuk pertanyaan atau permintaan terkait data Anda. Ganti seluruh keterangan contoh ini dengan kebijakan dan kontak resmi perusahaan sebelum peluncuran.</p></section>
        </div>
    </article>
</section>
@endsection
