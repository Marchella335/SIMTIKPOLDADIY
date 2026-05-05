@extends('layouts.admin')
@section('title', 'Manajemen Keuangan - Admin SIMTIK')
@section('page-title', 'Manajemen Keuangan & Anggaran')

@section('styles')
<style>
:root {
    --primary: #1a3c34;
    --primary-light: #2d5a4e;
    --accent: #c8a96e;
    --danger: #ef4444;
    --success: #22c55e;
    --info: #3b82f6;
    --gray-50: #f8f9fa;
    --gray-100: #f1f3f5;
    --gray-200: #e9ecef;
    --gray-300: #dee2e6;
    --gray-500: #adb5bd;
    --gray-700: #495057;
    --gray-900: #212529;
    --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    --radius: 12px;
}

.finance-wrapper { display: flex; flex-direction: column; gap: 20px; font-family: 'Inter', sans-serif; }

/* FUND SELECTOR BAR */
.fund-selector-bar {
    background: #fff; padding: 20px; border-radius: var(--radius); border: 1px solid var(--gray-200);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;
    box-shadow: var(--shadow);
}
.fund-info { display: flex; align-items: center; gap: 15px; flex: 1; }
.fund-select-wrapper { min-width: 250px; }
.fund-select { 
    width: 100%; padding: 10px 15px; border-radius: 8px; border: 1px solid var(--gray-300); 
    font-size: 14px; font-weight: 600; color: var(--primary); outline: none; background: var(--gray-50);
}
.fund-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,60,52,0.1); }

/* TOP CARDS */
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.stat-card { 
    background: #fff; padding: 20px; border-radius: var(--radius); border: 1px solid var(--gray-200);
    box-shadow: var(--shadow); position: relative; overflow: hidden;
}
.stat-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; }
.card-pagu::before { background: var(--primary); }
.card-realisasi::before { background: var(--danger); }
.card-saldo::before { background: var(--success); }

.stat-label { font-size: 11px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
.stat-value { font-size: 20px; font-weight: 800; color: var(--gray-900); font-family: 'Poppins', sans-serif; }
.stat-sub { font-size: 12px; color: var(--gray-500); margin-top: 5px; }

/* SHEET MANAGEMENT */
.sheet-container { background: #fff; border-radius: var(--radius); border: 1px solid var(--gray-200); box-shadow: var(--shadow); overflow: hidden; }
.sheet-tabs { display: flex; background: var(--gray-100); padding: 10px 15px 0; gap: 5px; overflow-x: auto; border-bottom: 1px solid var(--gray-300); }
.tab { 
    padding: 10px 20px; border-radius: 8px 8px 0 0; font-size: 13px; font-weight: 600; color: var(--gray-500); 
    cursor: pointer; background: var(--gray-200); transition: all 0.2s; white-space: nowrap; border: 1px solid var(--gray-300); border-bottom: none;
}
.tab:hover { background: var(--gray-300); color: var(--gray-700); }
.tab.active { background: #fff; color: var(--primary); border-color: var(--gray-300); border-bottom-color: #fff; margin-bottom: -1px; }
.tab-close { margin-left: 10px; font-size: 14px; opacity: 0.5; }
.tab-close:hover { color: var(--danger); opacity: 1; }

.sheet-toolbar { padding: 15px 20px; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center; background: #fff; }
.sheet-title { font-size: 16px; font-weight: 700; color: var(--primary); border: none; outline: none; background: transparent; width: 100%; max-width: 400px; }
.sheet-title:focus { border-bottom: 2px solid var(--primary); }

.tbl-container { overflow-x: auto; }
.sheet-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.sheet-table th { background: var(--gray-50); padding: 12px 15px; text-align: left; font-weight: 700; color: var(--gray-700); border-bottom: 2px solid var(--gray-200); text-transform: uppercase; font-size: 11px; }
.sheet-table td { padding: 0; border-bottom: 1px solid var(--gray-100); }
.cell-input { width: 100%; padding: 12px 15px; border: 1px solid transparent; outline: none; background: transparent; transition: all 0.1s; }
.cell-input:focus { background: var(--gray-50); border-color: var(--primary); }

/* MODALS */
.modal-bg { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
.modal { background: #fff; width: 450px; border-radius: var(--radius); overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
.modal-header { padding: 20px; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center; background: var(--gray-50); }
.modal-header h3 { font-size: 16px; font-weight: 700; color: var(--primary); }
.modal-body { padding: 20px; display: flex; flex-direction: column; gap: 15px; }
.modal-footer { padding: 15px 20px; border-top: 1px solid var(--gray-200); display: flex; justify-content: flex-end; gap: 10px; }

.form-group label { display: block; font-size: 12px; font-weight: 700; color: var(--gray-700); margin-bottom: 6px; }
.form-control { width: 100%; padding: 10px 15px; border-radius: 8px; border: 1px solid var(--gray-300); font-size: 14px; outline: none; }
.form-control:focus { border-color: var(--primary); }

/* ALERTS & TOASTS */
.toast-msg { position: fixed; bottom: 30px; right: 30px; z-index: 3000; background: var(--primary); color: #fff; padding: 12px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; display: none; box-shadow: var(--shadow); }
.toast-msg.error { background: var(--danger); }

.balance-warning { color: var(--danger); font-size: 11px; font-weight: 700; margin-top: 5px; display: none; }

.empty-state { padding: 100px 20px; text-align: center; color: var(--gray-500); }
.empty-state i { font-size: 48px; margin-bottom: 15px; display: block; opacity: 0.3; }
</style>
@endsection

@section('content')
<div class="finance-wrapper">
    {{-- TOP BAR --}}
    <div class="fund-selector-bar">
        <div class="fund-info">
            <div class="fund-select-wrapper">
                <label style="font-size: 11px; font-weight: 700; color: var(--gray-500); display: block; margin-bottom: 4px;">PILIH SUMBER DANA / PAGU</label>
                <select class="fund-select" id="fundSelect" onchange="onSourceChange()">
                    @forelse($sumberDanas as $sd)
                        <option value="{{ $sd->id }}" data-pagu="{{ $sd->pagu }}">{{ $sd->nama }} ({{ $sd->tahun }})</option>
                    @empty
                        <option value="">Belum ada sumber dana</option>
                    @endforelse
                </select>
            </div>
            <button class="btn btn-primary" onclick="openModal('modalSource')">
                <i class="fas fa-plus-circle"></i> Tambah Sumber Dana
            </button>
            <button class="btn btn-danger" onclick="deleteCurrentSource()" id="btnDeleteSource" style="display:none;">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </div>
        <div class="fund-actions">
            <button class="btn btn-outline" onclick="openNewSheet()">
                <i class="fas fa-file-invoice"></i> Buat Sheet Acara Baru
            </button>
        </div>
    </div>

    {{-- STATS GRID --}}
    <div class="stats-grid">
        <div class="stat-card card-pagu">
            <div class="stat-label">Total Pagu Dana</div>
            <div class="stat-value" id="valPagu">Rp 0</div>
            <div class="stat-sub" id="lblFundName">-</div>
        </div>
        <div class="stat-card card-realisasi">
            <div class="stat-label">Total Pengeluaran</div>
            <div class="stat-value" id="valRealisasi">Rp 0</div>
            <div class="stat-sub" id="lblSheetCount">0 sheet acara</div>
        </div>
        <div class="stat-card card-saldo">
            <div class="stat-label">Saldo Tersisa</div>
            <div class="stat-value" id="valSaldo">Rp 0</div>
            <div class="stat-sub" id="warnBalance" style="color: var(--danger); font-weight: 700; display: none;">
                <i class="fas fa-exclamation-triangle"></i> Saldo Tidak Mencukupi!
            </div>
        </div>
    </div>

    {{-- SHEET CONTAINER --}}
    <div class="sheet-container">
        <div class="sheet-tabs" id="sheetTabs">
            <!-- Tabs will be rendered here -->
        </div>
        <div id="sheetContent">
            <div class="empty-state" id="emptyState">
                <i class="fas fa-folder-open"></i>
                <p>Pilih sumber dana atau buat sheet acara baru untuk mulai mencatat.</p>
            </div>
            <div id="activeSheetArea" style="display: none;">
                <div class="sheet-toolbar">
                    <div style="flex: 1; display: flex; align-items: center; gap: 15px;">
                        <input class="sheet-title" id="activeSheetTitle" onchange="updateSheetTitle()" />
                        <div class="fund-select-wrapper" style="min-width: 150px;">
                            <select class="fund-select" id="activeSheetPeriode" onchange="updateSheetTitle()" style="padding: 5px 10px; font-size: 12px;">
                                <option value="Triwulan I">Triwulan I</option>
                                <option value="Triwulan II">Triwulan II</option>
                                <option value="Triwulan III">Triwulan III</option>
                                <option value="Triwulan IV">Triwulan IV</option>
                                <option value="Tahunan">Tahunan</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <span id="saveStatus" style="font-size: 11px; color: var(--gray-500); font-weight: 600;"></span>
                        <button class="btn btn-sm btn-primary" onclick="saveActiveSheet(true)" id="btnManualSave">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button class="btn btn-sm btn-success" onclick="addRow()"><i class="fas fa-plus"></i> Tambah Baris</button>
                        <button class="btn btn-sm btn-outline" onclick="exportPDF()"><i class="fas fa-file-pdf"></i> PDF</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteActiveSheet()"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="tbl-container">
                    <table class="sheet-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th style="width: 140px;">Tanggal</th>
                                <th>Deskripsi Kegiatan</th>
                                <th style="width: 150px;">Kategori</th>
                                <th style="width: 120px;">Tipe</th>
                                <th style="width: 160px; text-align: right;">Nominal (Rp)</th>
                                <th style="width: 40px;"></th>
                            </tr>
                        </thead>
                        <tbody id="sheetBody">
                            <!-- Rows rendered here -->
                        </tbody>
                    </table>
                </div>
                <div style="padding: 15px 20px; background: var(--gray-50); border-top: 1px solid var(--gray-200); display: flex; flex-direction: column; gap: 8px; font-weight: 700; font-size: 14px;">
                    <div style="display: flex; justify-content: space-between; color: var(--danger);">
                        <span>Total Pengeluaran Sheet ini:</span>
                        <span id="sheetTotal">Rp 0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; color: var(--primary); border-top: 1px dashed var(--gray-300); padding-top: 8px;">
                        <span>Saldo Tersisa (Pagu Dana - Pengeluaran):</span>
                        <span id="sheetRemaining">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL: TAMBAH SUMBER DANA --}}
<div class="modal-bg" id="modalSource">
    <div class="modal">
        <div class="modal-header">
            <h3>Tambah Sumber Dana Baru</h3>
            <button class="btn-close" onclick="closeModal('modalSource')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Sumber Dana</label>
                <input class="form-control" id="sNama" placeholder="Contoh: DIPA TA 2025" />
            </div>
            <div class="form-group">
                <label>Total Pagu Anggaran (Rp)</label>
                <input class="form-control" type="number" id="sPagu" placeholder="0" />
            </div>
            <div class="form-group">
                <label>Tahun Anggaran</label>
                <input class="form-control" type="number" id="sTahun" value="{{ date('Y') }}" />
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('modalSource')">Batal</button>
            <button class="btn btn-primary" onclick="saveSource()">Simpan Sumber Dana</button>
        </div>
    </div>
</div>

{{-- MODAL: BUAT SHEET ACARA --}}
<div class="modal-bg" id="modalAcara">
    <div class="modal">
        <div class="modal-header">
            <h3>Buat Sheet Acara Baru</h3>
            <button class="btn-close" onclick="closeModal('modalAcara')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Acara / Kegiatan</label>
                <input class="form-control" id="aNama" placeholder="Contoh: Pelatihan Cyber Crime" />
            </div>
            <div class="form-group">
                <label>Tanggal Pelaksanaan</label>
                <input class="form-control" type="date" id="aTanggal" value="{{ date('Y-m-d') }}" />
            </div>
            <div class="form-group">
                <label>Dana Awal (Opsional - Masuk sebagai Pemasukan)</label>
                <input class="form-control" type="number" id="aDana" placeholder="0" />
            </div>
            <div class="form-group">
                <label>Periode Pelaporan</label>
                <select class="form-control" id="aPeriode">
                    <option value="Triwulan I">Triwulan I</option>
                    <option value="Triwulan II">Triwulan II</option>
                    <option value="Triwulan III">Triwulan III</option>
                    <option value="Triwulan IV">Triwulan IV</option>
                    <option value="Tahunan">Tahunan</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('modalAcara')">Batal</button>
            <button class="btn btn-primary" onclick="saveAcara()">Buat Sheet</button>
        </div>
    </div>
</div>

<div class="toast-msg" id="toast">Notifikasi...</div>
@endsection

@section('scripts')
<script>
const CSRF_TOKEN = '{{ csrf_token() }}';
let allSheets = [];
let activeSheetIdx = -1;
let currentSourceId = null;
let currentSourcePagu = 0;
let saveTimeout = null;

// Helpers
const fmt = n => 'Rp ' + (parseInt(n)||0).toLocaleString('id-ID');
const esc = s => String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');

function showToast(msg, isError = false) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = 'toast-msg' + (isError ? ' error' : '');
    t.style.display = 'block';
    setTimeout(() => t.style.display = 'none', 3000);
}

function openModal(id) { document.getElementById(id).style.display = 'flex'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }

// 1. SUMBER DANA LOGIC
async function saveSource() {
    const nama = document.getElementById('sNama').value;
    const pagu = document.getElementById('sPagu').value;
    const tahun = document.getElementById('sTahun').value;

    if(!nama || !pagu) return showToast('Lengkapi data!', true);

    try {
        const res = await fetch('{{ route('admin.keuangan.sumber_dana.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: JSON.stringify({ nama, pagu, tahun })
        });
        if(!res.ok) throw new Error();
        showToast('Sumber Dana berhasil ditambahkan');
        location.reload();
    } catch(e) { showToast('Gagal menyimpan', true); }
}

async function deleteCurrentSource() {
    if(!currentSourceId) return;
    if(!confirm('Hapus sumber dana "' + document.getElementById('lblFundName').textContent + '"? Semua sheet acara di dalamnya juga akan terhapus.')) return;
    
    try {
        const res = await fetch(`{{ url('admin/keuangan/sumber-dana') }}/${currentSourceId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
        });
        if(!res.ok) throw new Error();
        showToast('Sumber Dana berhasil dihapus');
        location.reload();
    } catch(e) { showToast('Gagal menghapus', true); }
}

function onSourceChange() {
    const sel = document.getElementById('fundSelect');
    currentSourceId = sel.value;
    
    const btnDel = document.getElementById('btnDeleteSource');
    if(currentSourceId) btnDel.style.display = 'inline-flex';
    else btnDel.style.display = 'none';

    const opt = sel.options[sel.selectedIndex];
    currentSourcePagu = parseFloat(opt.dataset.pagu || 0);
    
    document.getElementById('valPagu').textContent = fmt(currentSourcePagu);
    document.getElementById('lblFundName').textContent = opt.text;
    
    loadSheetsBySource(currentSourceId);
}

// 2. SHEET LOGIC
async function loadSheetsBySource(sourceId) {
    if(!sourceId) return;
    try {
        const res = await fetch(`{{ url('admin/keuangan/sumber-dana') }}/${sourceId}/acaras`);
        allSheets = await res.json();
        activeSheetIdx = allSheets.length > 0 ? 0 : -1;
        renderTabs();
        renderActiveSheet();
        updateGlobalStats();
    } catch(e) { showToast('Gagal memuat data', true); }
}

function openNewSheet() {
    if(!currentSourceId) return showToast('Pilih sumber dana terlebih dahulu', true);
    openModal('modalAcara');
}

async function saveAcara() {
    const nama = document.getElementById('aNama').value;
    const tgl = document.getElementById('aTanggal').value;
    const dana = document.getElementById('aDana').value || 0;
    const periode = document.getElementById('aPeriode').value;

    if(!nama) return showToast('Nama acara wajib diisi', true);

    try {
        const res = await fetch('{{ route('admin.keuangan.acara.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: JSON.stringify({ 
                nama_acara: nama, 
                tanggal: tgl, 
                dana_awal: dana, 
                periode_pelaporan: periode,
                sumber_dana_id: currentSourceId 
            })
        });
        const newData = await res.json();
        allSheets.unshift(newData);
        activeSheetIdx = 0;
        closeModal('modalAcara');
        renderTabs();
        renderActiveSheet();
        updateGlobalStats();
    } catch(e) { showToast('Gagal membuat sheet', true); }
}

function renderTabs() {
    const container = document.getElementById('sheetTabs');
    if(!allSheets.length) { container.innerHTML = ''; return; }
    
    container.innerHTML = allSheets.map((s, i) => `
        <div class="tab ${i === activeSheetIdx ? 'active' : ''}" onclick="switchSheet(${i})">
            <i class="fas fa-file-alt"></i> ${esc(s.nama_acara)}
        </div>
    `).join('');
}

function switchSheet(idx) {
    activeSheetIdx = idx;
    renderTabs();
    renderActiveSheet();
}

function renderActiveSheet() {
    const area = document.getElementById('activeSheetArea');
    const empty = document.getElementById('emptyState');
    
    if(activeSheetIdx === -1) {
        area.style.display = 'none';
        empty.style.display = 'block';
        return;
    }
    
    area.style.display = 'block';
    empty.style.display = 'none';
    
    const s = allSheets[activeSheetIdx];
    document.getElementById('activeSheetTitle').value = s.nama_acara;
    document.getElementById('activeSheetPeriode').value = s.periode_pelaporan || 'Triwulan I';
    renderRows();
}

function renderRows() {
    const s = allSheets[activeSheetIdx];
    const body = document.getElementById('sheetBody');
    const kategoriOpts = ['Konsumsi','Akomodasi','Transportasi','Perlengkapan','Dokumentasi','Honorarium','Lain-lain'];
    
    body.innerHTML = (s.items || []).map((item, i) => {
        const katOpts = kategoriOpts.map(k => `<option value="${k}" ${item.kategori===k?'selected':''}>${k}</option>`).join('');
        const isExp = item.tipe === 'Pengeluaran';
        return `
            <tr>
                <td style="text-align:center">${i+1}</td>
                <td><input type="date" class="cell-input" value="${item.tanggal||''}" onchange="updateCell(${i}, 'tanggal', this.value)"></td>
                <td><input class="cell-input" value="${esc(item.uraian)}" placeholder="Ketik deskripsi..." onchange="updateCell(${i}, 'uraian', this.value)"></td>
                <td>
                    <select class="cell-input" onchange="updateCell(${i}, 'kategori', this.value)">
                        ${katOpts}
                    </select>
                </td>
                <td>
                    <select class="cell-input" style="font-weight:700; color:${isExp?'var(--danger)':'var(--success)'}" onchange="updateCell(${i}, 'tipe', this.value)">
                        <option value="Pengeluaran" ${isExp?'selected':''}>Keluar</option>
                        <option value="Pemasukan" ${!isExp?'selected':''}>Masuk</option>
                    </select>
                </td>
                <td>
                    <input type="number" class="cell-input" style="text-align:right; font-weight:700;" value="${item.nilai}" onchange="updateCell(${i}, 'nilai', this.value)">
                </td>
                <td style="text-align:center">
                    <button class="btn-close" onclick="removeRow(${i})" style="color:var(--gray-500)">&times;</button>
                </td>
            </tr>
        `;
    }).join('');
    
    const total = (s.items || []).reduce((a, b) => b.tipe === 'Pengeluaran' ? a + parseFloat(b.nilai||0) : a, 0);
    document.getElementById('sheetTotal').textContent = fmt(total);
    
    const remaining = currentSourcePagu - total;
    document.getElementById('sheetRemaining').textContent = fmt(remaining);
    document.getElementById('sheetRemaining').style.color = remaining < 0 ? 'var(--danger)' : 'var(--primary)';
}

function addRow() {
    if(activeSheetIdx === -1) return showToast('Pilih atau buat sheet terlebih dahulu', true);
    const s = allSheets[activeSheetIdx];
    if(!s.items) s.items = [];
    s.items.push({
        id: 'new_' + Date.now(),
        tanggal: new Date().toISOString().slice(0,10),
        uraian: '',
        kategori: 'Lain-lain',
        tipe: 'Pengeluaran',
        nilai: 0
    });
    renderRows();
    queueSave();
}

function removeRow(idx) {
    allSheets[activeSheetIdx].items.splice(idx, 1);
    renderRows();
    queueSave();
}

function updateCell(rowIdx, field, val) {
    const s = allSheets[activeSheetIdx];
    s.items[rowIdx][field] = val;
    hasUnsavedChanges = true;
    if(field === 'nilai' || field === 'tipe') {
        renderRows();
        updateGlobalStats();
    }
    queueSave();
}

let hasUnsavedChanges = false;
window.onbeforeunload = function() {
    if(hasUnsavedChanges) return "Ada perubahan yang belum tersimpan. Tetap keluar?";
};

// 3. SYNC & STATS
function updateGlobalStats() {
    let totalExp = 0;
    let totalInc = 0;
    let sheetCount = 0;

    allSheets.forEach(s => {
        sheetCount++;
        (s.items || []).forEach(item => {
            if(item.tipe === 'Pengeluaran') totalExp += parseFloat(item.nilai || 0);
            else totalInc += parseFloat(item.nilai || 0);
        });
    });

    const saldo = currentSourcePagu + totalInc - totalExp;

    document.getElementById('valRealisasi').textContent = fmt(totalExp);
    document.getElementById('valSaldo').textContent = fmt(saldo);
    document.getElementById('lblSheetCount').textContent = sheetCount + ' sheet acara';
    
    const warn = document.getElementById('warnBalance');
    warn.style.display = saldo < 0 ? 'block' : 'none';
}

function queueSave() {
    if(saveTimeout) clearTimeout(saveTimeout);
    document.getElementById('saveStatus').textContent = 'Menunggu...';
    saveTimeout = setTimeout(saveActiveSheet, 1500);
}

async function saveActiveSheet(manual = false) {
    const s = allSheets[activeSheetIdx];
    if(!s) return;
    
    const statusEl = document.getElementById('saveStatus');
    statusEl.textContent = manual ? 'Menyimpan...' : 'Autosaving...';
    if(manual) {
        document.getElementById('btnManualSave').disabled = true;
    }

    try {
        const res = await fetch(`{{ url('admin/keuangan/acara') }}/${s.id}/items`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: JSON.stringify({ items: s.items })
        });
        if(!res.ok) throw new Error();
        
        const result = await res.json();
        if(result.items) {
            // Update local IDs to prevent duplicate creation
            s.items.forEach((item, i) => {
                const serverItem = result.items[i];
                if(serverItem && (item.id === serverItem.id || String(item.id).startsWith('new_'))) {
                    item.id = serverItem.id;
                }
            });
        }

        statusEl.textContent = 'Tersimpan';
        hasUnsavedChanges = false;
        setTimeout(() => { if(statusEl.textContent === 'Tersimpan') statusEl.textContent = ''; }, 3000);
    } catch(e) { 
        console.error('Save failed');
        statusEl.textContent = 'Gagal menyimpan!';
        statusEl.style.color = 'var(--danger)';
    } finally {
        if(manual) {
            document.getElementById('btnManualSave').disabled = false;
        }
    }
}

async function updateSheetTitle() {
    const s = allSheets[activeSheetIdx];
    s.nama_acara = document.getElementById('activeSheetTitle').value;
    s.periode_pelaporan = document.getElementById('activeSheetPeriode').value;
    try {
        await fetch(`{{ url('admin/keuangan/acara') }}/${s.id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: JSON.stringify({ 
                nama_acara: s.nama_acara, 
                periode_pelaporan: s.periode_pelaporan,
                sumber_dana_id: currentSourceId 
            })
        });
        renderTabs();
    } catch(e) {}
}

async function deleteActiveSheet() {
    if(!confirm('Hapus sheet ini secara permanen?')) return;
    const s = allSheets[activeSheetIdx];
    try {
        await fetch(`{{ url('admin/keuangan/acara') }}/${s.id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
        });
        allSheets.splice(activeSheetIdx, 1);
        activeSheetIdx = allSheets.length > 0 ? 0 : -1;
        renderTabs();
        renderActiveSheet();
        updateGlobalStats();
    } catch(e) {}
}

function exportPDF() {
    window.print();
}

// Init
document.addEventListener('DOMContentLoaded', () => {
    if(document.getElementById('fundSelect').value) {
        onSourceChange();
    }
});
</script>
@endsection
