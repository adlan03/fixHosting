<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

/**
 * Kumpulan fungsi layanan untuk operasi keluarga dan pengaturan.
 */

function is_settings_locked($db = null): bool
{
    return false;
}

function update_settings($db, int $harga, float $beras, float $jagung): void
{
    // disimpan hanya secara virtual; tidak ada DB
}

function set_setting_lock($db, bool $locked): void
{
    // no-op
}

function collect_members_from_post(array $post): array
{
    $members = [];
    if (empty($post['nama']) || !is_array($post['nama'])) {
        return $members;
    }

    foreach ($post['nama'] as $i => $nama) {
        $nama = trim((string)$nama);
        if ($nama === '') {
            continue;
        }

        $members[] = [
            'nama'   => $nama,
            'jk'     => $post['jk'][$i] ?? '',
            'uang'   => isset($post['uang'][$i]) ? 1 : 0,
            'beras'  => isset($post['beras'][$i]) ? 1 : 0,
            'jagung' => isset($post['jagung'][$i]) ? 1 : 0,
        ];
    }

    return $members;
}

function insert_family($db, string $kepala, int $infaq): int
{
    return 0;
}

function insert_members($db, int $familyId, array $members): void
{
    // no-op
}

function save_family($db, string $kepala, int $infaq, array $members): void
{
    // tidak menyimpan ke mana pun
}

function fetch_family_members($db, int $familyId): array
{
    return [];
}

function fetch_all_families($db = null): array
{
    return [];
}

function delete_family($db, int $familyId): void
{
    // no-op
}

function reset_all_families($db): void
{
    // no-op
}

function replace_family($db, int $familyId, int $infaq, array $members): void
{
    // no-op
}

function calculate_family_totals(array $family, array $setting): array
{
    $totals = [
        'uang' => 0.0,
        'beras' => 0.0,
        'jagung' => 0.0,
        'infaq' => (int)($family['infaq'] ?? 0),
    ];

    foreach ($family['anggota'] as $member) {
        if (!empty($member['uang'])) {
            $totals['uang'] += setting_value($setting, 'harga');
        }
        if (!empty($member['beras'])) {
            $totals['beras'] += setting_value($setting, 'beras');
        }
        if (!empty($member['jagung'])) {
            $totals['jagung'] += setting_value($setting, 'jagung');
        }
    }

    return $totals;
}

function calculate_overall_totals(array $families, array $setting): array
{
    $overall = ['uang' => 0.0, 'beras' => 0.0, 'jagung' => 0.0, 'infaq' => 0];
    foreach ($families as $family) {
        $familyTotals = calculate_family_totals($family, $setting);
        $overall['uang'] += $familyTotals['uang'];
        $overall['beras'] += $familyTotals['beras'];
        $overall['jagung'] += $familyTotals['jagung'];
        $overall['infaq'] += $familyTotals['infaq'];
    }

    return $overall;
}
