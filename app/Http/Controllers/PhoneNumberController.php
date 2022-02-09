<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;

class PhoneNumberController extends Controller
{
    private const PHONE_NUMBER_REGEX = '/^((\+?38))?0\d{9}$/';

    private const PHONE_NUMBER_VALIDATOR = [
        'phone_number' => 'required|regex:' . self::PHONE_NUMBER_REGEX . '|min:10|max:13|unique:phone_numbers,phone_number',
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
        $validated = $request->validate([
            'phone_number' => ['required', 'regex:' . self::PHONE_NUMBER_REGEX, 'min:10', 'max:13',
                Rule::unique('phone_numbers', 'phone_number')->ignore($phoneNumber)]
        ]);

        $phoneNumber = PhoneNumber::find($phoneNumber);
        $phoneNumber->phone_number = $request->phone_number;
        $phoneNumber->save();

        return redirect()->route('contact.show', ['contact' => $phoneNumber->contact]);
    }


    /**
     * Delete phone number
     * @param PhoneNumber $phoneNumber
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(PhoneNumber $phonenumber)
    {

        $contact = Contact::find($phonenumber->contact->id);

        if ($contact->phoneNumber->count() <= 1) {
            return redirect()->back()->withSuccess('Must have one phone number!');
        }

        $phonenumber->delete();

        return redirect()->back();
    }
}
