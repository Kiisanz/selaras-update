<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mDashboard extends CI_Model
{
    public function customer()
    {
        $this->db->select('COUNT(nama_customer) as nama_customer');
        $this->db->from('customer');
        return $this->db->get()->row();
    }

    public function pemasukkan()
    {
        $this->db->select('SUM(total_bayar) as pemasukkan');
        $this->db->from('transaksi');
        return $this->db->get()->row();
    }
    public function user()
    {
        $this->db->select('COUNT(nama_user) as user');
        $this->db->from('user');
        return $this->db->get()->row();
    }

    public function top_selling()
    {
        $data = $this->db->query("SELECT 
                SUM(detail_transaksi.qty) as total, 
                produk.nama_produk, 
                size.size,
                transaksi.ongkir, 
                transaksi.total_bayar - transaksi.ongkir as harga_setelah_ongkir,
                transaksi.tgl_transaksi as tanggal, 
                detail_transaksi.id_transaksi
            FROM detail_transaksi
            LEFT JOIN size ON detail_transaksi.id_size = size.id_size
            LEFT JOIN produk ON size.id_produk = produk.id_produk
            LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi
            GROUP BY detail_transaksi.id_size, detail_transaksi.id_transaksi
            ORDER BY total DESC")->result();

        $response = [];
        foreach ($data as $row) {
            $response[] = [
                'total' => (int) $row->total,
                'nama_produk' => $row->nama_produk,
                'size' => $row->size,
                'harga' => (int) $row->harga_setelah_ongkir,
                'tanggal' => $row->tanggal
            ];
        }

        return $response;
    }



    public function pelanggan_list()
    {
        return $this->db->query("
            SELECT 
                COALESCE(customer.nama_customer, 'Unknown') AS nama_customer,
                COALESCE(customer.alamat_customer, 'Unknown') AS alamat_customer,
                MAX(transaksi.tgl_transaksi) AS tgl_transaksi_terakhir,
                SUM(CASE WHEN transaksi.status_pesan = 1 THEN custom.qty_custom ELSE 0 END) AS total_custom_qty,
                COUNT(CASE WHEN transaksi.status_pesan = 2 THEN transaksi.id_transaksi END) AS total_pembelian,
                SUM(CASE WHEN transaksi.status_pesan = 1 THEN custom.qty_custom ELSE 0 END) +
                COUNT(CASE WHEN transaksi.status_pesan = 2 THEN transaksi.id_transaksi END) AS total_transaksi
            FROM transaksi
            LEFT JOIN customer ON transaksi.id_customer = customer.id_customer
            LEFT JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi
            LEFT JOIN size ON detail_transaksi.id_size = size.id_size
            LEFT JOIN produk ON size.id_produk = produk.id_produk
            LEFT JOIN custom ON transaksi.id_transaksi = custom.id_transaksi
            GROUP BY customer.id_customer, 
                     customer.nama_customer, 
                     customer.alamat_customer
            ORDER BY total_transaksi DESC
        ")->result();
    }

    public function get_pelanggan_data()
    {
        $data = $this->pelanggan_list();
        echo json_encode($data);
    }
}    

/* End of file mDasboard.php */
