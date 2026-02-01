<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan; 
use App\Models\PaymentGateway;
use App\Models\SmsGateway;
use App\Models\Courierapi;
use Toastr;
use File;
use Str;
use Image;
use DB;

class ApiIntegrationController extends Controller
{
    
     
    public function pay_manage ()
    {
        $bkash = PaymentGateway::where('type','=','bkash')->first();
        $shurjopay = PaymentGateway::where('type','=','shurjopay')->first();
        return view('backEnd.apiintegration.pay_manage',compact('bkash','shurjopay'));
    }
    
    public function pay_update(Request $request)
    {
      
        $update_data = PaymentGateway::find($request->id);
        $input = $request->all();
        $input['status'] = $request->status?1:0;
        $update_data->update($input);
        
        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
    
    public function sms_manage ()
    {  
        $sms = SmsGateway::first();
        return view('backEnd.apiintegration.sms_manage',compact('sms'));
    }
    
    public function sms_update(Request $request)
    {
      
        $update_data = SmsGateway::find($request->id);
        $input = $request->all();
        $input['status'] = $request->status?1:0;
        $input['order'] = $request->order?1:0;
        $input['forget_pass'] = $request->forget_pass?1:0;
        $input['password_g'] = $request->password_g?1:0;
        $update_data->update($input);
        
        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
    
    public function courier_manage ()
    {
        $steadfast = Courierapi::where('type','=','steadfast')->first();
        $pathao = Courierapi::where('type','=','pathao')->first();
        return view('backEnd.apiintegration.courier_manage',compact('steadfast','pathao'));
    }
    
    public function courier_update (Request $request)
    {
      
        $update_data = Courierapi::find($request->id);
        $input = $request->all();
        $input['status'] = $request->status?1:0;
        $update_data->update($input);
        
        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
    
    


        
    public function smtp_update(Request $request)
    {
        $envData = [
            'MAIL_MAILER'        => $request->MAIL_MAILER,
            'MAIL_HOST'          => $request->MAIL_HOST,
            'MAIL_PORT'          => $request->MAIL_PORT,
            'MAIL_USERNAME'      => $request->MAIL_USERNAME,
            'MAIL_PASSWORD'      => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION'    => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS'  => $request->MAIL_FROM_ADDRESS,
            'MAIL_FROM_NAME'     => $request->MAIL_FROM_NAME,
        ];
    
        $this->updateEnvFile($envData); 
    
        Artisan::call('config:clear');
        Artisan::call('config:cache');
    
        Toastr::success('Success', 'SMTP configuration updated successfully!');
        return redirect()->back();
    }
    
  
    private function updateEnvFile($data)
    {
        $envPath = base_path('.env');
    
        if (!file_exists($envPath)) {
            return false;
        }
    
        $envContent = file_get_contents($envPath);
    
        foreach ($data as $key => $value) {
            $pattern = "/^$key=.*$/m";
            $line = "$key=\"$value\"";
    
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $line, $envContent);
            } else {
                $envContent .= "\n$line";
            }
        }
    
        file_put_contents($envPath, $envContent);
    
        return true;
    }

public function smtp_manage()
{
    $smtp = [
        'MAIL_MAILER'     => config('mail.default'),
        'MAIL_HOST'       => config('mail.mailers.smtp.host'),
        'MAIL_PORT'       => config('mail.mailers.smtp.port'),
        'MAIL_USERNAME'   => config('mail.mailers.smtp.username'),
        'MAIL_PASSWORD'   => config('mail.mailers.smtp.password'),
        'MAIL_ENCRYPTION' => config('mail.mailers.smtp.encryption'),
        'MAIL_FROM_ADDRESS' => config('mail.from.address'),
        'MAIL_FROM_NAME'    => config('mail.from.name'),
    ];

    return view('backEnd.apiintegration.smtp_manage', compact('smtp'));
}
    
}