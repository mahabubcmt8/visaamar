<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;


    private static $contact;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $directory;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'contact-image/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newContact($request)
    {
        self::$contact = new Contact();
        self::$contact->address = $request->address;
        self::$contact->phone = $request->phone;
        self::$contact->email = $request->email;
        self::$contact->facebook = $request->facebook;
        self::$contact->Instagram = $request->Instagram;
        self::$contact->LinkedIn = $request->LinkedIn;
        self::$contact->twitter = $request->twitter;
        self::$contact->Blogger = $request->Blogger;
        self::$contact->WhatsApp = $request->WhatsApp;
        self::$contact->image      = self::getImageUrl($request);
        self::$contact->save();
    }

    public static function updateContact($request, $id)
    {
        self::$contact = Contact::findOrFail(1);
        if ($request->file('image'))
        {
            if (file_exists(self::$contact->image))
            {
                unlink(self::$contact->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$contact->image;
        }

        self::$contact->address = $request->address;
        self::$contact->phone = $request->phone;
        self::$contact->email = $request->email;
        self::$contact->facebook = $request->facebook;
        self::$contact->Instagram = $request->Instagram;
        self::$contact->LinkedIn = $request->LinkedIn;
        self::$contact->twitter = $request->twitter;
        self::$contact->Blogger = $request->Blogger;
        self::$contact->WhatsApp = $request->WhatsApp;
        self::$contact->image      = self::$imageUrl;
        self::$contact->save();
    }
}
