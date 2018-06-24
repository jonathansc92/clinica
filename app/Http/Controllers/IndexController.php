<?php

namespace App\Http\Controllers;
use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;



class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index()
    {
        
        $var['qtdMedicos'] = \App\Models\Medicos::all()->count();
        $var['qtdPacientes'] = \App\Models\Pacientes::all()->count();
        $var['qtdPlanos'] = \App\Models\Planos::all()->count();
        $var['qtdEspecialidades'] = \App\Models\Especialidades::all()->count();
        $var['qtdAgendamentos'] = \App\Models\Agendamentos::all()->count();
        
        return view('index')->with('var', $var);
    }
	
	public function videoToMp3(){
		/*$FFMpeg = FFMpeg::create([
            'ffmpeg.binaries'  => 'C:/FFmpeg/bin/ffmpeg.exe', // the path to the FFMpeg binary
            'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe', // the path to the FFProbe binary
            'timeout'          => 3600, // the timeout for the underlying process
            'ffmpeg.threads'   => 12,   // the number of threads that FFMpeg should use
        ]);*/
	//$p = FFMpeg::fromDisk('videos')->open(storage_path('166575970.mp4'));
//$p =	storage_path('166575970.mp4');

	
	
		
	     FFMpeg::fromDisk('local')
            ->open('videos/166575970.mp4')
            ->export()
            ->inFormat(new \FFMpeg\Format\Audio\MP3)
            ->save('audios/'.time().'.mp3');

        return 'Audio gerado';

	}
}
