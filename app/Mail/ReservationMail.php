<?php

namespace App\Mail;

use App\Http\Middleware\User;
use App\Models\Hostel;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $userName;
    protected string $hostelName;
    protected string $roomName;
    protected string $location;
    protected string $inDate;
    protected string $outDate;
    protected string $occupants;


    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->userName = $reservation->user->username;
        $this->hostelName = $reservation->hostel->name;
        $this->roomName = $reservation->room->name;
        $this->location = $reservation->hostel->location;
        $this->inDate = $reservation->check_in;
        $this->outDate = $reservation->check_out;
        $this->occupants = $reservation->occupants;
    }

//    public function __construct(Hostel $hostel, Room $room, User $user)
//    {
//        $this->hostel = $hostel;
//        $this->room = $room;
//        $this->user = $user;
//    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('example@demo.com', 'Test Sender'),
            subject: 'Reservation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.reservation',
            with: [
                'user' => $this->userName,
                'hostel' => $this->hostelName,
                'room' => $this->roomName,
                'location' => $this->location,
                'count' => $this->occupants,
                'in' => $this->inDate,
                'out' => $this->outDate
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
