<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use HasFactory;


    private static $about;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $directory;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'about-image/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newAbout($request)
    {
        self::$about = new AboutSection();
        self::$about->description = $request->description;
        self::$about->image      = self::getImageUrl($request);
        self::$about->save();
    }

    public static function updateAbout($request, $id)
    {
        self::$about = AboutSection::findOrFail(1);
        if ($request->file('image'))
        {
            if (file_exists(self::$about->image))
            {
                unlink(self::$about->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$about->image;
        }
        self::$about->description = $request->description;
        self::$about->image      = self::$imageUrl;
        self::$about->save();
    }

}
