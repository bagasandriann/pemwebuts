<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'pass', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pass');

        $akunku = $this->db->get_where('akunku', ['email' => $email])->row_array();
        if ($akunku) {
            if (password_verify($password, $akunku['pass'])) {
                $data = [
                    'email' => $akunku['email'],
                    'is_admin' => $akunku['is_admin'],
                ];
                $this->session->set_userdata($data);
                if ($akunku['is_admin'] == 1) {
                    redirect('auth/admin');
                } else {
                    redirect('User');
                }
            } else {
                $this->session->set_flashdata('regismsg', '<div class ="alert alert-danger" role="alert">Wrong Password</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('regismsg', '<div class ="alert alert-danger" role="alert">Account Is Not Registered</div>');
            redirect('auth');
        }
    }


    public function regis()
    {
        $data['title'] = 'Beritaku User Registration';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/registration');
        $this->load->view('templates/auth_footer');
    }

    public function regis_action()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[akunku.email]');
        $this->form_validation->set_rules('pass', 'Password', 'required|trim');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Gender', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->regis();
        } else {
            $data = [
                'email' => $this->input->post('email', true),
                'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                'first_name' => $this->input->post('first_name', true),
                'last_name' => $this->input->post('last_name', true),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'pp' => 'default.jpg',
                'is_admin' => 0
            ];

            $this->db->insert('akunku', $data);
            $this->session->set_flashdata('regismsg', '<div class ="alert alert-sucess" role="alert">Account Registration Succeed! Please Login');
            redirect('auth');
        };
    }
    public function admin()
    {
        $this->load->view('auth/admin');
        echo "admin ";
        $ud = isset($_GET['action']) ? $_GET['action'] : null;; //edit atau delete berita
        $queryC = isset($_POST['query']) ? $_POST['query'] : null; //insert to badanberita create


        // echo '<div class="container">';
        // echo '<div class="modal fade" id="myModal" role="dialog">';
        // echo '<div class="modal-dialog">';
        // echo '<div class="modal-content">';
        // echo '<div class="modal-header">';
        // echo '<h4 class="modal-title">Create new article</h4>';
        // echo '</div>';
        // echo '<div class="modal-body">';
        // echo '<form action="./do/queryArticle.php" method="post">';
        // echo '<div class="mb-3">';
        // echo '<label for="title" class="form-label">Title *</label>';
        // echo '<input type="text" class="form-control" id="title" name="title" value="">';
        // echo '</div>';
        // echo '<button type="" class="">Submit</button>';
        // echo '<a href="" class="">Cancel</a>';
        // echo '</form>';
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';

        if ($_POST) {
            $input = $_POST['view'];
            echo $queryC;
            if ($input == "berita") {
                echo "berita";

                $query = $this->db->get('berita');
                echo "<table id='table' class='table table-striped' style='width:100%;'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Judul</th>";
                echo "<th>ID Penulis</th>";
                echo "<th>Tanggal Bikin</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($query->result() as $row) {
                    echo "<tr>";
                    echo "<td>", $row->id, "</td>";
                    echo "<td>", $row->judul, "</td>";
                    echo "<td>", $row->id_penulis, "</td>";
                    echo "<td>", $row->datetime_created, "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary' href='admin?id=", $row->id, "&action=edit'>Edit</a>";
                    echo "&nbsp<a class='btn btn-danger' href='admin?id=", $row->id, "&action=delete'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                };
                echo "</tbody>";
                echo "</table>";

                echo "<form action='admin' method='post'>";
                echo "<label for='new' hidden></label>";
                echo "<input type='hidden' name='view' id='view' value='new'>";
                echo "<button type='submit'>Berita baru</button>";
                echo "</form>";
            } else if ($input == "akun") {
                $query = $this->db->get('akunku');
                echo "<table id='table' class='table table-striped' style='width:100%;'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID User</th>";
                echo "<th>Email</th>";
                echo "<th>Nama Lengkap</th>";
                echo "<th>Password</th>";
                echo "<th>Tanggal Lahir</th>";
                echo "<th>Jenis Kelamin</th>";
                echo "<th>Foto</th>";
                echo "<th>Role</th>";
                // echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($query->result() as $row) {
                    echo "<tr>";
                    echo "<td>", $row->id_user, "</td>";
                    echo "<td>", $row->email, "</td>";
                    echo "<td>", $row->first_name, ' ', $row->last_name, "</td>";
                    echo "<td>", $row->pass, "</td>";

                    // echo "<td><input type='password' value'", $row->pass, "' id='userPass'>";
                    // echo "<input type='checkbox' onclick='showUserPass()'>";
                    // echo "</td>";

                    echo "<td>", $row->tanggal_lahir, "</td>";
                    if ($row->jenis_kelamin) {
                        $gender = 'Laki-laki';
                    } else {
                        $gender = 'Perempuan';
                    }
                    echo "<td>", $gender, "</td>";
                    echo "<td><img src='", $row->pp, "'></img></td>";
                    if ($row->is_admin) {
                        $role = 'Admin';
                    } else {
                        $role = 'User';
                    }
                    echo "<td>", $role, "</td>";
                    // echo "<td>", 'action button', "</td>";
                };
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
            } else if ($input == "new") {
                echo "<form method='post' action='./admin'>";
                echo "<label for='judul'>Judul : </label>";
                echo "<input type='text' id='query' name='query' value=''>";
                echo "<br><button type='submit'>Create</button>";
            }


            if ($queryC != null) {
                $this->form_validation->set_rules("judul", "Judul", "required|trim");
                if ($this->form_validation->run() == false) {
                    echo "Berita telah";
                    $query = array(
                        'judul' => $queryC,
                        'id_penulis' => '8',
                    );
                    $this->db->set('datetime_created', 'NOW()', FALSE); //current_timestamp()
                    $this->db->insert("berita", $query);

                    //Tambah badan berita untuk editing
                    $this->db->select_max('id', 'id');
                    $maxIdArray = $this->db->get('berita'); // Produces: SELECT MAX(id) as id_berita FROM berita
                    foreach ($maxIdArray->result() as $row) {
                        $max_id = isset($row->id) ? $row->id : 0;
                        echo $max_id;
                    }
                    $query2 = array(
                        'id_berita' => $max_id,
                        'isi' => '',
                    );
                    $this->db->insert("badanberita", $query2);
                } else {
                    echo "true";
                }
            }
        } else {

            if ($ud != null) {
                $the_id = $_GET['id'];
                if ($ud == 'edit') {
                    echo  "<form><input</form>";
                } else if ($ud == 'delete') {
                    echo  "Berita dengan ID: " . $the_id . " deleted";
                    $this->db->delete('berita', array('id' => $the_id));
                    $this->db->delete('badanberita', array('id_berita' => $the_id));
                }
            }
        }
        echo "'</div>'<br>";
        $this->load->view('templates/auth_footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_admin');

        $this->session->set_flashdata('regismsg', '<div class ="alert alert-sucess" role="alert">Log Out Succeed!');
        redirect('auth');
    }
}
