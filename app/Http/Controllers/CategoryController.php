<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\Multipic;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use App\Models\User;
use BaconQrCode\Renderer\Color\Rgb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Location;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat(){
        $categories = Category::latest()->get();
        $trashCat = Category::onlyTrashed()->latest()->paginate(24);
        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Category was added successfully.',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function EditCat($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }

    public function UpdateCat(Request $request, $id){
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Category was successfully updated.',
            'alert-type' => 'warning'
        );
        return Redirect()->route('all.category')->with($notification);
    }

    public function DelCat($id){
        Category::find($id)->delete();
        $notification = array(
            'message' => 'Category was successfully move to Trash Category.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function ResCat($id){
        Category::withTrashed()->find($id)->restore();
        $notification = array(
            'message' => 'Category was successfully restored.',
            'alert-type' => 'info'
        );
        return Redirect()->back()->with($notification);
    }

    public function RemoveCat($id){
        Category::onlyTrashed()->find($id)->forceDelete();
        $notification = array(
            'message' => 'Category was completely removed.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('admin.brand.index',compact('brands'));
    }

    public function AddBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'File type must be jpeg, jpg or png',
        ]);
        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $file_location = 'images/brands/';
        $last_img = $file_location.$img_name;
        $brand_image->move($file_location,$img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Brand was added successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditBrand($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }

    public function UpdateBrand(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
        ],
        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'File type must be jpeg, jpg or png',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $file_location = 'images/brands/';
            $last_img = $file_location.$img_name;
            $brand_image->move($file_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand was successfully updated.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.brand')->with($notification);
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand was successfully updated.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.brand')->with($notification);
        }
    }

    public function DelBrand($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        $notification = array(
            'message' => 'Brand was successfully deleted.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function AllImage(){
        $image = Multipic::all();
        return view('admin.multi.index',compact('image'));
    }

    public function AddImages(Request $request){
        $image = $request->file('image');

        foreach($image as $multi){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($multi->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $file_location = 'images/multi/';
            $last_img = $file_location.$img_name;
            $multi->move($file_location,$img_name);

            Multipic::insert([
                'images' => $request->image,
                'images' => $last_img,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Images was successfully added.',
                'alert-type' => 'success'
            );
        }
        return Redirect()->back()->with($notification);
    }

    public function AllSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.add');
    }

    public function StoreSlider(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'description' => 'required|unique:sliders|max:255',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $image = $request->file('image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $file_location = 'images/sliders/';
        $last_img = $file_location.$img_name;
        $image->move($file_location,$img_name);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'New Slider was added successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.slider')->with($notification);
    }

    public function EditSlider($id){
        $sliders = Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));
    }

    public function UpdateSlider(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'description' => 'required|unique:sliders|max:255',
        ]);
        $old_slider = $request->old_slider;
        $image = $request->file('image');

        if($image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $file_location = 'images/sliders/';
            $last_img = $file_location.$img_name;
            $image->move($file_location,$img_name);

            unlink($old_slider);
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Slider was updated successfully.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.slider')->with($notification);
        }else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Slider was updated successfully.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.slider')->with($notification);
        }
    }

    public function DelSlider($id){
        $sliders = Slider::find($id)->delete();
        $notification = array(
            'message' => 'Slider was deleted successfully.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function AllAbout(){
        $About = About::latest()->get();
        return view('admin.about.index',compact('About'));
    }

    public function AddAbout(){
        return view('admin.about.add');
    }

    public function StoreAbout(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:abouts|max:255',
            'short_description' => 'required|unique:abouts|max:255',
            'long_description' => 'required|unique:abouts|max:255',
        ]);
        About::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'About has been added successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.about')->with($notification);
    }

    public function EditAbout($id){
        $about = About::find($id);
        return view('admin.about.edit',compact('about'));
    }

    public function UpdateAbout(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|unique:abouts|max:255',
            'short_description' => 'required|unique:abouts|max:255',
            'long_description' => 'required|unique:abouts|max:700',
        ]);
        About::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'updated' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'About was successfully updated.',
            'alert-type' => 'info'
        );
        return Redirect()->route('all.about')->with($notification);
    }

    public function DeleteAbout($id){
        About::find($id)->delete();
        $notification = array(
            'message' => 'Successfully deleted.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function AllServices(){
        $services = Service::latest()->get();
        return view('admin.services.index',compact('services'));
    }

    public function AddService(){
        return view('admin.services.add');
    }

    public function StoreService(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:services|max:255',
            'description' => 'required|unique:services|max:255',
            'icon' => 'required|mimes:jpg,jpeg,png',
        ]);
        $icon = $request->file('icon');

        $name_gen = hexdec(uniqid());
        $icon_ext = strtolower($icon->getClientOriginalExtension());
        $icon_name = $name_gen.'.'.$icon_ext;
        $file_location = 'images/icons/';
        $last_icon = $file_location.$icon_name;
        $icon->move($file_location,$icon_name);

        Service::insert([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $last_icon,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'New Service was added successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.services')->with($notification);
    }

    public function EditService($id){
        $services = Service::find($id);
        return view('admin.services.edit',compact('services'));
    }

    public function UpdateService(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|unique:services|max:255',
            'description' => 'required|unique:services|max:255',
        ]);
        $old_service = $request->old_service;
        $icon = $request->file('icon');

        if($icon){
            $name_gen = hexdec(uniqid());
            $icon_ext = strtolower($icon->getClientOriginalExtension());
            $icon_name = $name_gen.'.'.$icon_ext;
            $file_location = 'images/icons/';
            $last_icon = $file_location.$icon_name;
            $icon->move($file_location,$icon_name);

            unlink($old_service);
            Service::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'icon' => $last_icon,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Successfully updated.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.services')->with($notification);
        }else{
            Service::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Successfully updated.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.services')->with($notification);
        }
    }

    public function TeamAdmin(){
        $team = Team::all();
        return view('admin.team.index',compact('team'));
    }

    public function AddTeam(){
        return view('admin.team.add');
    }

    public function StoredTeam(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:teams|max:255',
            'position' => 'required|unique:teams|max:255',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $image = $request->file('image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $file_location = 'images/teams/';
        $last_img = $file_location.$img_name;
        $image->move($file_location,$img_name);

        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Team was successfully inserted.',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.team')->with($notification);
    }

    public function TeamEdit($id){
        $team = Team::find($id);
        return view('admin.team.edit',compact('team'));
    }

    public function UpdateTeam(Request $request, $id){
        $old_image = $request->old_image;
        $image = $request->file('image');

        if($image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $file_location = 'images/teams/';
            $last_img = $file_location.$img_name;
            $image->move($file_location,$img_name);

            unlink($old_image);
            Team::find($id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Team was successfully updated.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.team')->with($notification);
        }else{
            Team::find($id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Team was successfully updated.',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.team')->with($notification);
        }
    }

    public function DeleteTeam($id){
        Team::find($id)->delete();
        $notification = array(
            'message' => 'Team was successfully deleted.',
            'alert-type' => 'warning'
        );
    return Redirect()->back()->with($notification);
    }








    public function PortFolio(){
        $multipics = Multipic::all();
        return view('pages.portfolio',compact('multipics'));
    }

    public function AboutPage(){
        $about = About::all();
        return view('pages.about',compact('about'));
    }

    public function Services(){
        $service = Service::all();
        return view('pages.services',compact('service'));
    }

    public function Team(){
        $team = Team::all();
        return view('pages.team',compact('team'));
    }








    public function AdminContact(){
        $contact = Contact::latest()->get();
        return view('admin.contact.index',compact('contact'));
    }

    public function AdminCreateContact(){
        return view('admin.contact.add');
    }

    public function StoreContact(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:contacts|max:255',
            'phone' => 'required|unique:contacts|max:255',
            'address' => 'required|unique:contacts|max:500',
        ],
        [
            'email.required' => 'Email is required.',
            'phone.required' => 'Phone is required.',
            'address.required' => 'Address is required.',
        ]);
        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Contact was successfully stored.',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.contact')->with($notification);
    }

    public function EditContact($id){
        $edit = Contact::find($id);
        return view('admin.contact.editcon',compact('edit'));
    }

    public function UpdateContact(Request $request, $id){
        $validated = $request->validate([
            'email' => 'required|unique:contacts|max:255',
            'phone' => 'required|unique:contacts|max:255',
            'address' => 'required|unique:contacts|max:500',
        ],
        [
            'email.required' => 'Email is required.',
            'phone.required' => 'Phone is required.',
            'address.required' => 'Address is required.',
        ]);
        Contact::find($id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'Updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Contact was successfully updated.',
            'alert-type' => 'info'
        );
        return Redirect()->route('admin.contact')->with($notification);
    }

    public function HomeContact(){
        $contacts = Contact::latest()->get();
        return view('pages.contact',compact('contacts'));
    }

    public function DeleteContacts($id){
        Contact::find($id)->delete();
        $notification = array(
            'message' => 'Contact was deleted successfully.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function ContactForm(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:contact_forms|max:255',
            'email' => 'required|unique:contact_forms|max:255',
            'subject' => 'required|unique:contact_forms|max:255',
            'message' => 'required|unique:contact_forms|max:999',
        ],
        [
            'name.required' => 'Please input your name',
            'email.required' => 'Please input your email',
            'subject.required' => 'Subject is required.',
            'message.required' => 'Message is required!',
        ]);
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Message was successfully sent.',
            'alert-type' => 'success'
        );
        return Redirect()->route('home.contact')->with($notification);
    }

    public function AdminMessage(){
        $contactform = ContactForm::latest()->get();
        return view('pages.message',compact('contactform'));
    }

    public function MessageView($id){
        $message = ContactForm::find($id);
        return view('pages.view',compact('message'));
    }

    public function DeleteMsg($id){
        ContactForm::find($id)->delete();
        $notification = array(
            'message' => 'Message was successfully deleted.',
            'alert-type' => 'warning'
        );
        return Redirect()->route('admin.message')->with($notification);
    }











    public function ChangePass(){
        return view('admin.body.changepassword');
    }

    public function UpdatePassword(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashPass = Auth::user()->password;
        if(Hash::check($request->old_password,$hashPass)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'User logout successfully.',
                'alert-type' => 'success'
            );

            return Redirect()->route('login')->with($notification);
        }else{
            $notification = array(
                'message' => 'Current password is invalid.',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function UpdateProfile(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
                if($user){
                    return  view('admin.body.update_profile',compact('user'));
                }
        }
    }

    public function  UpdateUserProfile(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            $notification = array(
                'message' => 'Successfully updated.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }




    public function logout(){
        Auth::logout();
        $notification = array(
            'message' => 'User successfully logout.',
            'alert-type' => 'success'
        );
        return Redirect()->route('login')->with($notification);
    }
}
