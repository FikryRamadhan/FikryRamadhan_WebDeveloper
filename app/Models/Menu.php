<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [''];

    /**
     * Relationship
     */
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getUserName(){
        return $this->user?$this->user->nama: '-';
    }

    /**
     * Function CRUD
     */
    public static function createMenu($request){
        $menu = self::create($request);
        $menu->update([
            'id_user' => auth()->user()->id
        ]);
        return $menu;
    }

    public function updateMenu($request){
        return $this->update($request);
    }

    public function menuDestroy(){
		// $this->removeMenuPhoto();
        return $this->delete();
    }

    /**
     * Save Image
     */

    public function saveImage($request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $data = $request->caption;
            $fileName = date('Ymd_').$file->getClientOriginalName();
            $file->move(storage_path('app/public/photo/'),$fileName); 
            $this->update([
                'image' => $fileName
            ]);
        }
    }

	public function removeMenuPhoto()
	{
		if($this->isHasMenuPhoto()) {
			\File::delete($this->imageFilePath());
			$this->update([
				'image' => null
			]);
		}

		return $this;
	}



    /**
     * Data Table
     */
    public static function DataTable(){
        $data = self::select([ 'menus.*' ]);

        $data->where('id_user', auth()->user()->id);

        return DataTables::eloquent($data)
        ->addColumn('action', function ($data) {
            $action = '
                <div class="dropdown">
                    <button class="btn btn-danger px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit"href="' . route('menu.edit', $data->id) . '">
                            <i class="fas fa-pencil-alt mr-1"></i> Edit
                        </a>
                        <a class="dropdown-item delete" href="javascript:void(0)" data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?" data-delete-href="' . route('menu.destroy', $data->id) . '">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </a>
                    </div>
                </div>
            ';
            return $action;
        })
        ->editColumn('image', function($data){
            return $data->menuFileLinkHtml();
        })
        ->editColumn('id_user', function($data){
            return $data->getUserName();
        })
        ->rawColumns([ 'action', 'image' ])
        ->make(true);
    }

    public static function DataTableForCustomer(){
        $data = self::select([ 'menus.*' ]);

        return DataTables::eloquent($data)
        ->editColumn('image', function($data){
            return $data->menuFileLinkHtml();
        })
        ->editColumn('id_user', function($data){
            return $data->getUserName();
        })
        ->rawColumns([ 'image' ])
        ->make(true);
    }

    public function imageFilePath()
	{
		return storage_path('app/public/photo/'.$this->image);
	}


    public function menuPhotoFileLink()
	{
		return url('storage/photo/'.$this->image);
	}

	public function menuFileLinkHtml()
	{
		if($this->isHasMenuPhoto()) {
			$href = '<a href="'.$this->menuPhotoFileLink().'" target="_blank"> Lihat Photo Menu </a>';
			return $href;
		} else {
			return '<span class="text-danger"> Tidak Melampirkan Photo </span>';
		}
	}

	public function isHasMenuPhoto()
	{
		if(empty($this->image)) return false;
		return \File::exists($this->imageFilePath());
	}
}
