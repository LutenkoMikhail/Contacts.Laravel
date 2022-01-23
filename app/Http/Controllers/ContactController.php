<?php

namespace App\Http\Controllers;

use App\Filters\ContractFilter;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Nette\Utils\DateTime;

class ContactController extends Controller
{
    private $dateNow;

    /** Construct
     */
    public function __construct()
    {
        $this->dateNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $this->paginate = Config::get('constants.paginate.paginate_10');
    }

    /** Show contacts
     * @param ContractFilter $filter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(ContractFilter $filter)
    {
        $contacts = Contact::filter($filter)->with('phoneNumber')->
        orderBy('name')->paginate($this->paginate);

        return view('index',
            ['contacts' => $contacts]);
    }

    /** Show contact
     * @param Contact $contact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Contact $contact)
    {
        return view('contract.show',
            ['contact' => $contact]);
    }

    /** Show create contact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('contract.create');
    }

    /** Save contact to date base
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
            'surname' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:contacts,email',
            'birthday' => 'required|date_format:Y-m-d|before_or_equal:' . $this->dateNow->modify(Config::get('constants.full_age.full_age_18')),
        ]);
        $contact = new Contact($request->only('name','surname','email','birthday'));
        $contact->save();

        return redirect()->route('index');
    }

    /** Show edit contact
     * @param Contact $contact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Contact $contact)
    {
        return view('contract.edit',
            [
                'contact' => $contact
            ]
        );
    }

    /** Update contact
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
            'surname' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:contacts,email,' . $contact->id,
            'birthday' => 'required|date_format:Y-m-d|before_or_equal:' . $this->dateNow->modify(Config::get('constants.full_age.full_age_18')),
        ]);

        $contact->surname = $request->surname;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->birthday = $request->birthday;

        $contact->save();

        return redirect()->route('index');
    }

    /** Delete contact
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('index');
    }
}
