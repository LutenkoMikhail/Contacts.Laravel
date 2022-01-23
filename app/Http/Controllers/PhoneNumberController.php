<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PhoneNumberController extends Controller
{
    private const PHONE_NUMBER_VALIDATOR = [
        'phone_number' => 'required|regex:/^\+?[\s\-\(\)0-9]{10,14}$/|min:10|max:13|unique:phone_numbers,phone_number',
    ];

    /** View create phone number
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(int $id)
    {
        return view('phonenumber.create',
            ['id' => $id]);
    }

    /** Create phone number
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, int $id)
    {
        $validated = $request->validate(self::PHONE_NUMBER_VALIDATOR);

        $phoneNumber = new PhoneNumber($request->only('phone_number'));
        $phoneNumber->contact_id = $id;
        $phoneNumber->save();

        $contact = Contact::find($id);

        return redirect()->route('contact.show', ['contact' => $contact]);
    }

    /** View edit phone number
     * @param int $phoneNumberId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $phoneNumberId)
    {
        $phoneNumber = PhoneNumber::find($phoneNumberId);

        return view('phonenumber.edit',
            [
                'phoneNumber' => $phoneNumber
            ]
        );
    }

    /** Update phone number
     * @param Request $request
     * @param int $phoneNumber
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $phoneNumber)
    {
        $validated = $request->validate(self::PHONE_NUMBER_VALIDATOR);

        $phoneNumber = PhoneNumber::find($phoneNumber);
        $phoneNumber->phone_number = $request->phone_number;
        $phoneNumber->save();

        return redirect()->route('contact.show', ['contact' => $phoneNumber->contact]);
    }


    /** Delete phone number
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id)
    {
        PhoneNumber::destroy($id);

        return redirect()->back();
    }
}
