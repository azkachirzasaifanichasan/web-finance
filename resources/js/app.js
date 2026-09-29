/* ==========================================
   1. MODUL UI & TOAST SYSTEM (GLOBAL)
   ========================================== */
window.showToast = function (msg, type = 'success') {
    const existing = document.getElementById('app-toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.id = 'app-toast';
    
    const baseClasses = 'fixed bottom-8 left-1/2 -translate-x-1/2 px-5 py-3 rounded-xl text-xs sm:text-sm font-semibold opacity-0 pointer-events-none transition-all duration-300 z-[400] whitespace-nowrap shadow-[0_10px_25px_-5px_rgba(0,0,0,0.15)] flex items-center gap-3.5 font-sans ';
    const typeClasses = type === 'error' ? 'bg-red-500 text-white' : 'bg-emerald-500 text-white';

    toast.className = baseClasses + typeClasses;
    toast.setAttribute('role', 'status');
    toast.textContent = msg;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.remove('opacity-0', 'pointer-events-none');
        toast.classList.add('opacity-100', 'pointer-events-auto');
    });

    clearTimeout(toast._timer);
    toast._timer = setTimeout(() => {
        toast.classList.remove('opacity-100', 'pointer-events-auto');
        toast.classList.add('opacity-0', 'pointer-events-none');
        setTimeout(() => toast.remove(), 300);
    }, 2500);
};

window.showConfirm = function (msg, onOk) {
    const existing = document.getElementById('app-toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.id = 'app-toast';
    toast.className = 'fixed bottom-8 left-1/2 -translate-x-1/2 px-5 py-3 rounded-xl text-xs sm:text-sm font-semibold opacity-0 pointer-events-none transition-all duration-300 z-[400] bg-white text-slate-900 border border-slate-200 shadow-[0_10px_30px_-5px_rgba(15,23,42,0.15)] flex items-center gap-3.5 font-sans';
    toast.setAttribute('role', 'alertdialog');
    toast.innerHTML = `
        <span class="flex-1">${msg}</span>
        <div class="flex gap-2">
            <button id="toast-btn-ok" class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-bold transition-colors">OK</button>
            <button id="toast-btn-cancel" class="px-4 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-bold border border-slate-200 transition-colors">Cancel</button>
        </div>`;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.remove('opacity-0', 'pointer-events-none');
        toast.classList.add('opacity-100', 'pointer-events-auto');
    });

    document.getElementById('toast-btn-ok').onclick = () => { closeConfirm(toast); if (onOk) onOk(); };
    document.getElementById('toast-btn-cancel').onclick = () => { closeConfirm(toast); };
};

function closeConfirm(toast) {
    if (toast) {
        toast.classList.remove('opacity-100', 'pointer-events-auto');
        toast.classList.add('opacity-0', 'pointer-events-none');
        setTimeout(() => toast.remove(), 300);
    }
}

/* ==========================================
   2. INITIALIZER (Satu Listener untuk Semua Halaman)
   ========================================== */
document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // --- A. LOGIC DATA KAS SISWA ---
    if (document.getElementById('thead-row')) {
        const fixedColumns = ['nis', 'absen', 'nama'];
        let rawData = [];
        let pendingChanges = {};
        let openDropdown = null;

        async function loadDataKas() {
            try {
                const res = await fetch('/api/data-kas');
                rawData = await res.json();
                pendingChanges = {};
                openDropdown = null;
                renderTableKas();
                updateSaveBar();
            } catch (e) {
                console.error(e);
            }
        }

        function renderTableKas() {
            if (!rawData || rawData.length === 0) return;
            const allColumns = Object.keys(rawData[0]);
            const monthColumns = allColumns.filter(c => !fixedColumns.includes(c));

            const theadRow = document.getElementById('thead-row');
            theadRow.innerHTML = `
                <th class="px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider rounded-l-lg">Absent</th>
                <th class="px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider">NIS</th>
                <th class="px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider">Name</th>
                ${monthColumns.map((m, idx) => `
                    <th class="px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider ${idx === monthColumns.length - 1 ? 'rounded-r-lg' : ''}">${m.charAt(0).toUpperCase() + m.slice(1)}</th>
                `).join('')}`;

            const tbody = document.getElementById('tbody');
            tbody.innerHTML = '';

            rawData.forEach(row => {
                const cells = monthColumns.map(m => {
                    const key = `${row.absen}-${m}`;
                    const nominal = pendingChanges[key] !== undefined ? pendingChanges[key] : (parseInt(row[m]) || 0);
                    const isPending = pendingChanges[key] !== undefined;
                    const pendingCls = isPending ? 'border-amber-500 shadow-[0_0_0_2px_rgba(245,158,11,0.2)]' : '';
                    const isOpen = openDropdown === key;
                    const isY = nominal >= 10000;

                    if (isY) {
                        return `
                        <td class="align-middle px-2 py-1.5 border-b border-slate-100 text-xs">
                            <div class="flex flex-col items-center gap-1 min-h-[64px] justify-start relative">
                                <button class="w-[52px] h-[30px] rounded-lg text-[11px] font-bold uppercase tracking-wide border-2 cursor-pointer transition-all hover:scale-105 bg-emerald-100 text-emerald-700 border-emerald-300 ${pendingCls}"
                                    onclick="window.setNominal(${row.absen}, '${m}', 0)">Y</button>
                            </div>
                        </td>`;
                    } else {
                        const nominalLabel = (nominal > 0 && nominal < 10000)
                            ? `<span class="text-[10px] font-bold text-amber-700 bg-amber-100 border border-amber-200 rounded px-1.5 py-0.5 tracking-wide leading-none">${formatNominal(nominal)}</span>`
                            : '';
                        return `
                        <td class="align-middle px-2 py-1.5 border-b border-slate-100 text-xs">
                            <div class="flex flex-col items-center gap-1 min-h-[64px] justify-start relative">
                                <button class="w-[52px] h-[30px] rounded-lg text-[11px] font-bold uppercase tracking-wide border-2 cursor-pointer transition-all hover:scale-105 bg-slate-100 text-slate-500 border-slate-200 ${pendingCls}"
                                    onclick="window.setNominal(${row.absen}, '${m}', 10000)">N</button>
                                ${nominalLabel}
                                <button class="w-[52px] h-[20px] bg-white text-slate-500 border border-slate-300 rounded-md text-[10px] cursor-pointer flex items-center justify-center p-0 transition-all hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 ${isOpen ? 'bg-blue-50 text-blue-600 border-blue-200' : ''}"
                                    onclick="window.toggleDropdown(event, '${key}')">&#9660;</button>
                                ${isOpen ? buildDropdown(key, row.absen, m) : ''}
                            </div>
                        </td>`;
                    }
                }).join('');

                tbody.innerHTML += `
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-3.5 py-3 border-b border-slate-100 text-xs sm:text-sm text-slate-900">${row.absen}</td>
                    <td class="px-3.5 py-3 border-b border-slate-100 text-xs sm:text-sm text-slate-900">${row.nis || '-'}</td>
                    <td class="px-3.5 py-3 border-b border-slate-100 text-xs sm:text-sm text-slate-900 font-semibold">${row.nama}</td>${cells}
                </tr>`;
            });
        }

        function formatNominal(n) {
            if (n <= 0) return '';
            const k = n / 1000;
            return (Number.isInteger(k) ? k : parseFloat(k.toFixed(1))) + 'k';
        }

        function buildDropdown(key, absen, month) {
            return `
            <div class="absolute top-[calc(100%+4px)] left-1/2 -translate-x-1/2 bg-white border border-slate-200 rounded-xl p-2 z-[200] flex flex-col gap-1.5 min-w-[120px] shadow-[0_10px_25px_-5px_rgba(15,23,42,0.1)]">
                <button class="w-full py-1.5 bg-slate-50 hover:bg-blue-50 text-slate-900 hover:text-blue-600 border border-slate-200 hover:border-blue-200 rounded-lg text-xs font-semibold cursor-pointer transition-colors" onclick="window.selectAmount(event, ${absen}, '${month}', 5000)">5k</button>
                <div class="flex gap-1 items-center">
                    <input type="number" id="custom-${key}" min="0" max="10000" placeholder="0–10000"
                        class="w-[72px] px-1.5 py-1 text-xs border border-slate-300 rounded-md focus:outline-none focus:border-blue-600 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                        onclick="event.stopPropagation()" onkeydown="if(event.key==='Enter') window.confirmCustom(event, ${absen}, '${month}')">
                    <button class="px-2 py-1 bg-emerald-500 hover:bg-emerald-600 text-white rounded-md text-xs font-semibold cursor-pointer transition-colors" onclick="window.confirmCustom(event, ${absen}, '${month}')">OK</button>
                </div>
            </div>`;
        }

        function updateSaveBar() {
            const count = Object.keys(pendingChanges).length;
            const bar = document.getElementById('save-bar');
            const countLabel = document.getElementById('pending-count');
            if (count > 0) {
                bar?.classList.remove('hidden');
                if (countLabel) countLabel.textContent = `${count} unsaved change${count > 1 ? 's' : ''}`;
            } else {
                bar?.classList.add('hidden');
            }
        }

        // Global Handlers untuk Data Kas
        window.toggleDropdown = (event, key) => {
            event.stopPropagation();
            openDropdown = openDropdown === key ? null : key;
            renderTableKas();
        };

        window.selectAmount = (event, absen, month, amount) => {
            event.stopPropagation();
            window.setNominal(absen, month, amount);
        };

        window.confirmCustom = (event, absen, month) => {
            event.stopPropagation();
            const key = `${absen}-${month}`;
            const input = document.getElementById(`custom-${key}`);
            let val = parseInt(input.value, 10);

            if (isNaN(val) || val < 0 || val > 10000) {
                window.showToast('Nominal harus antara 0 dan 10000', 'error');
                return;
            }
            window.setNominal(absen, month, val);
        };

        window.setNominal = (absen, column, nominal) => {
            const key = `${absen}-${column}`;
            pendingChanges[key] = nominal;
            openDropdown = null;
            renderTableKas();
            updateSaveBar();
        };

        window.saveChanges = async () => {
            const keys = Object.keys(pendingChanges);
            for (const key of keys) {
                const lastDash = key.lastIndexOf('-');
                const absen = key.substring(0, lastDash);
                const column = key.substring(lastDash + 1);
                const value = pendingChanges[key];
                await fetch(`/api/data-kas/${absen}/${column}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ value })
                });
            }
            window.showToast('Perubahan berhasil disimpan!', 'success');
            loadDataKas();
        };

        window.cancelChanges = () => {
            pendingChanges = {};
            openDropdown = null;
            renderTableKas();
            updateSaveBar();
        };

        window.addMonth = async () => {
            const input = document.getElementById('new-month-input');
            const column = input?.value.trim();
            if (!column) return;
            await fetch('/api/data-kas/add-column', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ column })
            });
            input.value = '';
            loadDataKas();
        };

        // Jalankan awal
        loadDataKas();
    }

    // --- B. LOGIC PENGELUARAN (Trik Kalkulasi Total) ---
    if (document.getElementById('add-harga') && document.getElementById('add-jumlah')) {
        window.calculateTotal = () => {
            const harga = parseFloat(document.getElementById('add-harga')?.value) || 0;
            const jumlah = parseFloat(document.getElementById('add-jumlah')?.value) || 0;
            const total = harga * jumlah;
            const preview = document.getElementById('total-preview');
            if (preview) {
                preview.textContent = `Total: Rp ${total.toLocaleString('id-ID')}`;
            }
        };
    }

    // --- C. HANDLER TOGGLE FORM (PEMASUKAN & PENGELUARAN) ---
    window.showAddForm = () => {
        document.getElementById('add-form')?.classList.remove('hidden');
    };

    window.hideAddForm = () => {
        document.getElementById('add-form')?.classList.add('hidden');
    };
});