<div class="bg-white bg-gradient px-5" style="padding-top:8rem;padding-bottom: 5rem;">
    <p class="fw-bold">Dashboard Admin</p>

    <table class="table shadow-sm">
        <thead>
            <tr>
                <th class="w-50" colspan="2">Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-50">Jumlah Akun User</td>
                <th class="w-50">{{count(DB::select("select * from users;"))}}</th>
            </tr>
            <tr>
                <td class="w-50">Jumlah Akun User Perusahaan Terverifikasi</td>
                <th class="w-50">{{count(DB::select("select * from perusahaan_users where status_verifikasi = 'sudah';"))}}</th>
            </tr>
            <tr>
                <td class="w-50">Jumlah Akun User Perusahaan Belum diverifikasi</td>
                <th class="w-50">{{count(DB::select("select * from perusahaan_users where status_verifikasi = 'belum';"))}}</th>
            </tr>
            <tr>
                <td class="w-50">Jumlah Lowongan Kerja</td>
                <th class="w-50">0</th>
            </tr>
        </tbody>
    </table>
</div>
