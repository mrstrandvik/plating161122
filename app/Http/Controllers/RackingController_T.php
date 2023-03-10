<?php

namespace App\Http\Controllers;

use App\Models\MasterData;
use App\Models\Ng_Racking;
use App\Models\Pinbosh_Tertinggal;
use App\Models\racking_t;
use App\Models\Rencana_Produksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RackingController_T extends Controller
{
    //tampil data
    public function index(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $racking = DB::table('plating')
            ->leftJoin('masterdata', function ($join) {
                $join->on('masterdata.id', '=', 'plating.id_masterdata');
            })
            ->select('plating.id', 'plating.id_masterdata', 'plating.tanggal_r', 'plating.waktu_in_r', 'plating.no_bar', 'plating.no_part', 'plating.part_name', 'plating.katalis', 'plating.channel', 'plating.grade_color', 'plating.qty_bar', 'plating.cycle', 'plating.tgl_lot_prod_mldg')
            ->orderBy('tanggal_r', 'desc')
            ->orderBy('waktu_in_r', 'desc')
            ->where('tanggal_r', '=', $date)
            ->get();

        $masterdata = MasterData::all();

        $start_produksi = racking_t::where('tanggal_r', '=', $date)->min('waktu_in_r');
        $cycle_stop = racking_t::where('tanggal_r', '=', $date)->max('waktu_in_r');
        // dd($cycle_stop);

        return view('racking_t.racking_t', compact('racking', 'masterdata', 'date'));
    }

    //tambah data
    public function tambah(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $racking = racking_t::join('masterdata', 'masterdata.id', '=', 'plating.id_masterdata')
            ->select('plating.*', 'masterdata.part_name', 'masterdata.qty_bar')
            ->orderBy('tanggal_r', 'desc')
            ->get();


        $hit_data_racking = racking_t::where('tanggal_r', '=', $date)->count();
        $cycle = 75;
        $capacity_cooper = 34;
        $capacity_final = 38;
        $total_capacity = $capacity_cooper + $capacity_final;
        $count_rencana_produksi = Rencana_Produksi::where('tanggal', '=', $date)->count();
        $end_cycle = $count_rencana_produksi - $total_capacity;
        $fs_val = $end_cycle + $capacity_final;
        $cs_val = $fs_val + $capacity_cooper;
        // dd($hit_data_racking > $fs_val && $hit_data_racking < $cs_val);
        // $x = 19;
        // dd($x > 10 && $x < 20);
        // dd(430>429 && 450 > 466);

        $masterdata = MasterData::all();
        return view('racking_t.racking_t-tambah', compact(
            'racking',
            'masterdata',
            'hit_data_racking',
            'cycle',
            'capacity_cooper',
            'capacity_final',
            'total_capacity',
            'count_rencana_produksi',
            'end_cycle',
            'fs_val',
            'cs_val'
        ));
    }

    //simpan data
    public function simpan(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_r' => 'required',
            'no_bar' => 'required',
            'part_name' => 'required',
            'no_part' => 'required',
            'katalis' => 'required',
            'channel' => 'required',
            'grade_color' => 'required',
            'qty_bar' => 'required',
            'waktu_in_r' => 'required',
            'tgl_lot_prod_mldg' => 'required',
            'cycle' => 'required',
        ], [
            'tanggal_r.required' => 'Tgl Racking Harus Diisi!',
            'no_bar.required' => 'No Bar Harus Diisi!',
            'part_name.required' => 'Part Name Harus Diisi!',
            'no_part.required' => 'Part Number Harus Diisi!',
            'katalis.required' => 'katalis Harus Diisi!',
            'channel.required' => 'channel Harus Diisi!',
            'grade_color.required' => 'Grade Color Harus Diisi!',
            'qty_bar.required' => 'Qty Bar Harus Diisi!',
            'waktu_in_r.required' => 'waktu in racking Harus Diisi!',
            'tgl_lot_prod_mldg.required' => 'Tgl Lot Prod Molding Harus Diisi!',
            'cycle.required' => 'cycle Harus Diisi!',

        ]);

        $racking = racking_t::create([
            'id_masterdata' => $request->id_masterdata,
            'tanggal_r' => $request->tanggal_r,
            'waktu_in_r' => $request->waktu_in_r,
            'no_bar' => $request->no_bar,
            'part_name' => $request->part_name,
            'no_part' => $request->no_part,
            'katalis' => $request->katalis,
            'channel' => $request->channel,
            'grade_color' => $request->grade_color,
            'qty_bar' => $request->qty_bar,
            'waktu_in_r' => $request->waktu_in_r,
            'tgl_lot_prod_mldg' => $request->tgl_lot_prod_mldg,
            'cycle' => $request->cycle,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ]);
        // $masterdata = MasterData::find($request->id_masterdata);
        // $masterdata->stok_bc += $request->qty_bar;
        // $masterdata->save();
        return redirect()->route('racking_t.tambah', compact('racking'))->with('toast_success', 'Data Berhasil Disimpan!');
    }

    //edit data
    public function edit($id)
    {
        $plating = racking_t::findOrFail($id);
        $masterdata = MasterData::all();
        return view('racking_t.racking_t-edit', compact('plating', 'masterdata'));
    }

    //update data
    public function update(Request $request)
    {
        DB::table('plating')->where('id', $request->id)->update([
            'tanggal_r' => $request->tanggal_r,
            'no_bar' => $request->no_bar,
            'part_name' => $request->part_name,
            'no_part' => $request->no_part,
            'katalis' => $request->katalis,
            'channel' => $request->channel,
            'grade_color' => $request->grade_color,
            'qty_bar' => $request->qty_bar,
            'waktu_in_r' => $request->waktu_in_r,
            'tgl_lot_prod_mldg' => $request->tgl_lot_prod_mldg,
            'cycle' => $request->cycle,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('racking_t')->with('message', 'Data berhasil di update');
    }

    public function ajaxRacking(Request $request)
    {
        $id_masterdata['id_masterdata'] = $request->id_masterdata;
        $ajax_racking = MasterData::where('id', $id_masterdata)->get();

        return view('racking_t.racking_t-ajax', compact('ajax_racking'));
    }

    public function delete($id)
    {
        $plating = racking_t::find($id);
        $unracking = racking_t::where('id_masterdata', '=', $plating->id_masterdata)->first();

        if ($unracking->qty_aktual == '') {
            $masterdata = MasterData::find($plating->id_masterdata);
            $masterdata->stok_bc = $masterdata->stok_bc - $plating->qty_aktual;
            $masterdata->save();
            $plating->delete();
            return redirect()->route('racking_t')->with('success', 'Data Berhasil Dihapus!');
        } else
            return redirect()->route('racking_t')->with('errors', 'Data Gagal Dihapus!');
    }

    public function utama(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $start_produksi = $start_produksi = racking_t::where('tanggal_r', '=', $date)->min('waktu_in_r');
        $cycle_stop = racking_t::where('tanggal_r', '=', $date)->max('waktu_in_r');
        $jml_bar = racking_t::where('tanggal_r', '=', $date)->count();
        $ngracking_today = Ng_Racking::where('tanggal', '=', $date)->sum('quantity');
        $count_rencana_produksi = Rencana_Produksi::where('tanggal', '=', $date)->count();
        $sum_pinbosh_tertinggal = Pinbosh_Tertinggal::where('tanggal', '=', $date)->sum('jumlah');

        return view('racking_t.racking_t-menu_utama', compact('date', 'start_produksi', 'cycle_stop', 'jml_bar', 'ngracking_today', 'count_rencana_produksi','sum_pinbosh_tertinggal'));
    }

    public function ngracking()
    {
        $ngracking = Ng_Racking::all();
        return view('racking_t.ngracking', compact('ngracking'));
    }

    public function tambahngracking()
    {
        $ngracking = Ng_Racking::join('masterdata', 'masterdata.id', '=', 'ng_racking.id_masterdata')
            ->select('ng_racking.*', 'masterdata.part_name')
            ->get();

        $masterdata = MasterData::all();

        return view('racking_t.ngracking-tambah', compact('masterdata', 'ngracking'));
    }

    public function simpanngracking(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'id_masterdata' => 'required',
            'part_name' => 'required',
            'jenis_ng' => 'required',
            'quantity' => 'required',
        ], [
            'tanggal.required' => 'Tanggal Harus Diisi!',
            'id_masterdata.required' => 'Id Masterdata Harus Diisi!',
            'part_name.required' => 'Part Name Harus Diisi!',
            'jenis_ng.required' => 'Jenis NG Harus Diisi!',
            'quantity.required' => 'Quantity Harus Diisi!',

        ]);
        $ngracking = Ng_Racking::create([
            'tanggal' => $request->tanggal,
            'id_masterdata' => $request->id_masterdata,
            'part_name' => $request->part_name,
            'jenis_ng' => $request->jenis_ng,
            'quantity' => $request->quantity,

        ]);
        return redirect()->route('ngracking', compact('ngracking'))->with('success', 'Data Berhasil Disimpan!');
    }
    public function pinbosh()
    {
        $pinbosh = Pinbosh_Tertinggal::all();

        return view('racking_t.pinbosh', compact('pinbosh'));
    }
    public function pinboshTambah(){
        $masterdata = MasterData::all();
        return view('racking_t.pinbosh-tambah', compact('masterdata'));
    }
}
