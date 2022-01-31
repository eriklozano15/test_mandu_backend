<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Division;
use App\Models\Ambassador;

class divisionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
    }

    public function get_divisions_list()
    {
        $response = array();
        $response['status'] = 'success';

        $data_divisions = Division::select('divisions.id','divisions.name','divisions.level','divisions.collaborators','divisions.id_parent','d2.name as superior_division','divisions.id_ambassador','ambassadors.name as ambassador_name')
        ->withCount('children')
        ->Leftjoin('ambassadors','divisions.id_ambassador','=','ambassadors.id')
        ->Leftjoin('divisions as d2','divisions.id_parent','=','d2.id')
        ->get();

        $array_divisions = array();
        if(count($data_divisions) > 0){
            foreach($data_divisions as $key => $value){
                $array_divisions[$key]['id'] = $value->id;
                $array_divisions[$key]['name'] = $value->name?$value->name:'';
                $array_divisions[$key]['level'] = $value->level?$value->level:0;
                $array_divisions[$key]['collaborators'] = $value->collaborators?$value->collaborators:0;
                $array_divisions[$key]['id_parent'] = $value->id_parent?$value->id_parent:0;
                $array_divisions[$key]['superior_division'] = $value->superior_division?$value->superior_division:'';
                $array_divisions[$key]['id_ambassador'] = $value->id_ambassador?$value->id_ambassador:0;
                $array_divisions[$key]['ambassador_name'] = $value->ambassador_name?$value->ambassador_name:'';
                $array_divisions[$key]['subdivisions'] = $value->children_count;
            }
        }

        $response['data'] = $array_divisions;

        return response()->json( $response , 200 );
    }

    /* ------------------------------------------------------------------------------------------ */

    public function save_division(Request $request)
    {
        $response = array();
        $response['status'] = 'success';
        $response['message'] = '';

        $validator = Validator::make( $request->all() , [
            'name'   => 'required|unique:divisions|max:45',
            'id_parent'   => 'required',
            'level'   => 'required',
            'collaborators'   => 'required',
            'id_ambassador'   => 'required'
        ]);

        if ( $validator->fails() )
        {
            $response['status'] = 'error';
            $error_message = "";
            foreach ($validator->errors()->all() as $error){
                $error_message = $error_message . $error . ' ';
            }
            $response['message'] = $error_message;
            return response()->json( $response , 400 );
        }

        $data_insert = Division::create($request->all());
            
        if($data_insert->id){
            $response['message'] = 'División registrado.';
            return response()->json( $response , 200 );
        }else{
            $response['status'] = 'error';
            $response['message'] = 'No se pudo registrar, inténtelo de nuevo.';
            return response()->json( $response , 400 );
        }
    }

    /* ------------------------------------------------------------------------------------------ */

    public function update_division(Request $request)
    {
        $response = array();
        $response['status'] = 'success';
        $response['message'] = '';
        $validator = Validator::make( $request->all() , [
            'id' => 'required',
            'name'   => 'required|max:45',
            'id_parent'   => 'required',
            'level'   => 'required',
            'collaborators'   => 'required',
            'id_ambassador'   => 'required'
        ]);

        if ( $validator->fails() )
        {
            $response['status'] = 'error';
            $error_message = "";
            foreach ($validator->errors()->all() as $error){
                $error_message = $error_message . $error . ' ';
            }
            $response['message'] = $error_message;
            return response()->json( $response , 400 );
        }

        $data_update = Division::find( $request->id );
        if(!$data_update){
            $response['status'] = 'error';
            $response['message'] = 'División no encontrado.';
            return response()->json( $response , 400 );
        }

        $check_name = Division::where([['name',$request->name],['id','!=',$request->id]])->count();
        if($check_name > 0){
            $response['status'] = 'error';
            $response['message'] = 'El nombre debe ser único.';
            return response()->json( $response , 400 );
        }

        $data_update->fill( $request->all() );
        $data_update->save();
            
        if($data_update){
            $response['message'] = 'División actualizado.';
            return response()->json( $response , 200 );
        }else{
            $response['status'] = 'error';
            $response['message'] = 'No se pudo actualizar, inténtelo de nuevo.';
            return response()->json( $response , 400 );
        }
    }

    /* ------------------------------------------------------------------------------------------ */

    public function delete_division(Request $request)
    {
        $response = array();
        $response['status'] = 'success';
        $response['message'] = '';

        $validator = Validator::make( $request->all() , [
            'id' => 'required'
        ]);

        if ( $validator->fails() )
        {
            $response['status'] = 'error';
            $error_message = "";
            foreach ($validator->errors()->all() as $error){
                $error_message = $error_message . $error . ' ';
            }
            $response['message'] = $error_message;
            return response()->json( $response , 400 );
        }

        $data_delete = Division::find( $request->id );

        if(!$data_delete){
            $response['status'] = 'error';
            $response['message'] = 'División no encontrado.';
            return response()->json( $response , 400 );
        }

        $data_delete->delete();

        $response['message'] = 'División eliminado.';
        return response()->json( $response , 200 );
    }

    /* ------------------------------------------------------------------------------------------ */

    public function get_division($id)
    {
        $response = array();
        $response['status'] = 'success';
        $response['message'] = '';

        $data_division = Division::select('divisions.id','divisions.name','divisions.level','divisions.collaborators','d2.name as superior_division','ambassadors.name as ambassador_name')
        ->withCount('children')
        ->where('divisions.id',$id)
        ->Leftjoin('ambassadors','divisions.id_ambassador','=','ambassadors.id')
        ->Leftjoin('divisions as d2','divisions.id_parent','=','d2.id')
        ->first();

        if($data_division){
            $response['data'] = $data_division;
            return response()->json( $response , 200 );
        }else{
            $response['status'] = 'error';
            $response['message'] = 'División no encontrada.';
            return response()->json( $response , 400 );
        }        
    }

    /* ------------------------------------------------------------------------------------------ */

    public function get_subdivisions($id)
    {
        $response = array();
        $response['status'] = 'success';
        $response['message'] = '';

        $data_division = Division::select('id')->where('id',$id)->first();

        if($data_division){
            $data_subdivision = Division::select('id','name')->where('id_parent',$data_division->id)->get();
            $response['data'] = $data_subdivision;
            return response()->json( $response , 200 ); 
        }else{
            $response['status'] = 'error';
            $response['message'] = 'División no encontrada'; 
            return response()->json( $response , 400 ); 
        }
    }
}
