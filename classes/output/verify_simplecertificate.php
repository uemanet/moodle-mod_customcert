<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Contains class used to prepare a verification result for display.
 *
 * @package   mod_customcert
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_customcert\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;

/**
 * Class to prepare a verification result for display.
 *
 * @package   mod_customcert
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class verify_simplecertificate implements templatable, renderable {

    /**
     * @var string The user's fullname.
     */
    public $userfullname;

    /**
     * @var string The course's fullname.
     */
    public $coursefullname;

    /**
     * @var string The certificate's issue code.
     */
    public $code;

    /**
     * @var string The certificate's issue timecreated.
     */
    public $timecreated;

    /**
     * @var string The user's email.
     */
    public $email;

    /**
     * Constructor.
     *
     * @param \stdClass $certificate
     */
    public function __construct($certificate) {
        $this->userfullname = $certificate->firstname . ' ' . $certificate->lastname;
        $this->email = $certificate->email;
        $this->coursefullname = $certificate->coursename;
        $this->code = $certificate->code;
        $this->timecreated = userdate($certificate->timecreated);
    }

    /**
     * Function to export the renderer data in a format that is suitable for a mustache template.
     *
     * @param \renderer_base $output Used to do a final render of any components that need to be rendered for export.
     * @return \stdClass|array
     */
    public function export_for_template(\renderer_base $output) {
        $result = new \stdClass();
        $result->userfullname = $this->userfullname;
        $result->email = $this->email;
        $result->coursefullname = $this->coursefullname;
        $result->code = $this->code;
        $result->timecreated = $this->timecreated;

        return $result;
    }
}
