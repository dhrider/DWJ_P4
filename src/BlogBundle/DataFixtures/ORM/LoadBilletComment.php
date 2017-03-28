<?php
// src/BlogBundle/DataFixtures/ORM/LoadBilletComment.php

namespace BlogBundle\DataFixtures\ORM;

use BlogBundle\Entity\Billet;
use BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBilletComment implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $billets = array(
            array(
                new \DateTime(),
                "Episode 1",
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius, elit sit amet dapibus rhoncus, orci magna accumsan est, quis venenatis ex nunc vestibulum turpis. Praesent iaculis semper rutrum. Vivamus vel eleifend ipsum. Duis commodo est eu tortor pharetra vulputate. Ut tristique egestas nibh, non finibus orci viverra sit amet. Praesent suscipit ultrices finibus. Nunc dictum diam id tellus scelerisque elementum ac a erat. Duis non dolor tellus. Suspendisse ultrices metus vel quam vulputate maximus. Aliquam erat volutpat. Praesent scelerisque id sapien vel dignissim. Curabitur pulvinar eu eros in hendrerit. Pellentesque aliquam lacus quis suscipit tristique.

                Curabitur eget magna placerat, facilisis lacus non, vulputate ipsum. Ut tincidunt cursus euismod. Curabitur laoreet eleifend leo vel placerat. Nunc neque nisi, scelerisque a metus vitae, ultrices pellentesque lorem. Nulla euismod condimentum tellus nec consequat. Nunc commodo ac purus a volutpat. Integer venenatis, enim in eleifend iaculis, nunc velit bibendum sapien, eu consectetur libero ipsum auctor massa. Nullam varius ullamcorper tincidunt. Vestibulum vel justo diam. Nulla faucibus est at sapien facilisis pharetra. Donec imperdiet nisi dolor, non cursus massa blandit non. Vestibulum congue ipsum quis dignissim congue.

                Ut sit amet elit sit amet sem pulvinar gravida eget eu dui. In malesuada nulla tellus, a ornare dui vehicula nec. Morbi eleifend, tortor id dictum rhoncus, neque enim mattis ipsum, ut venenatis odio augue nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis enim vehicula, feugiat arcu porta, imperdiet ligula. Suspendisse maximus lectus in urna facilisis, sit amet porttitor velit rhoncus. Integer gravida et velit eu lacinia. Duis turpis ante, iaculis et venenatis ac, volutpat eu libero. Aliquam velit turpis, pellentesque quis ipsum nec, accumsan venenatis lacus. Fusce in dui molestie, auctor arcu aliquet, interdum enim. Suspendisse vel congue mauris. Aenean rhoncus nisl ut luctus rutrum. Vivamus maximus, nibh in porta bibendum, ante quam tincidunt massa, sit amet euismod dui diam non justo. Proin tristique tortor nec porttitor tincidunt. Sed iaculis finibus eros, eget interdum ex eleifend non.

                Duis eget mattis purus, vestibulum fringilla arcu. Pellentesque luctus erat ac orci interdum, ac cursus lacus eleifend. Sed dapibus ac eros id fermentum. Nunc in augue vel turpis auctor convallis a id ligula. Ut eu ipsum euismod, porta tellus eu, molestie quam. Cras hendrerit facilisis ligula, at auctor arcu blandit et. Donec elit sapien, porttitor vitae nisi nec, fringilla efficitur eros. Sed vel vestibulum orci, eget finibus dolor. In non ligula sed tellus imperdiet vulputate id nec arcu. Etiam posuere pellentesque neque. Suspendisse dignissim, urna a commodo iaculis, turpis magna ullamcorper magna, id euismod dolor ante in ex.

                Nullam tristique, felis eget malesuada facilisis, nisi libero condimentum massa, et commodo turpis risus a turpis. Mauris sollicitudin, turpis ac vehicula venenatis, nisl libero commodo velit, pharetra pulvinar arcu nisl eget urna. Donec vitae dignissim metus. Sed laoreet et justo vitae tempor. Etiam eget felis sit amet leo congue auctor. Donec finibus pellentesque odio, a faucibus orci bibendum non. Vivamus quis sapien nisl. Aliquam ullamcorper nisi ut felis posuere faucibus. Vestibulum pellentesque, enim porta dignissim ullamcorper, nisi ex congue orci, ac tempus libero nibh ut leo. Morbi placerat nibh neque, pretium pretium odio consequat sagittis. Vivamus consectetur ante a erat euismod, ac gravida nisl egestas. Aliquam enim ante, eleifend in vestibulum et, vestibulum et nulla. Pellentesque sed eros ultricies, pharetra arcu at, convallis turpis."
            ),
            array(
                new \DateTime(),
                "Episode 2",
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras accumsan erat blandit leo suscipit tempus. Praesent turpis justo, consequat eu est ac, viverra dapibus quam. Phasellus a purus sagittis, ultricies augue in, dignissim mauris. Ut vel elit augue. Pellentesque placerat massa tempor dolor hendrerit, at consequat lacus ultrices. Sed non feugiat purus. Proin id dolor neque. Proin imperdiet, nisi eu vulputate tempor, augue dui lacinia erat, ac porta metus nunc non diam. Quisque mauris augue, semper a ultricies sit amet, congue vel lacus. Nullam tincidunt arcu quis eleifend luctus. Nulla pretium porttitor turpis quis congue. Donec ullamcorper ut orci id pellentesque. Aenean iaculis eros justo, in suscipit arcu hendrerit sed. In pellentesque vel risus nec tempus. Curabitur feugiat felis at aliquet fringilla.

                Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus varius accumsan pulvinar. Nullam tempor est a ante consectetur rhoncus. Proin odio dui, tincidunt quis odio non, sodales feugiat justo. In hac habitasse platea dictumst. Ut semper commodo venenatis. Etiam sagittis, nisl sit amet auctor tempus, sem ante eleifend neque, nec lacinia felis urna sit amet felis. Pellentesque id suscipit eros, a mollis urna.

                Donec mollis erat vitae leo placerat, ac facilisis tellus hendrerit. Curabitur sit amet sagittis nisl, eu interdum lorem. Praesent tristique aliquet leo nec consequat. Nullam ultrices metus in auctor condimentum. Curabitur malesuada elementum elit, et hendrerit velit viverra ut. Proin quis tellus sed ex lacinia egestas vel nec metus. Ut pharetra ante id felis imperdiet, et vulputate eros suscipit. Nunc vel dignissim arcu, non facilisis nisl. Nulla facilisi. Vestibulum vitae ex est. Fusce lectus enim, ornare eget est vel, pharetra convallis est. Nam fermentum scelerisque auctor.

                Vestibulum a arcu in turpis viverra laoreet. Proin non ullamcorper lacus. Donec et malesuada nunc. Nunc in nisl vel leo malesuada tempor vitae a purus. Ut eu sapien mollis, sollicitudin sapien vitae, egestas libero. Praesent elementum, eros nec facilisis auctor, eros tortor dictum magna, in pellentesque mauris elit eu arcu. Donec consequat, diam sit amet sagittis ultricies, nulla odio finibus sapien, vel tristique tortor tortor fermentum tellus. Phasellus dictum, augue ut aliquam molestie, est erat sagittis dolor, ac bibendum ligula erat bibendum turpis. Cras nec dolor eu nisi tristique lacinia nec a tortor. Aenean mollis tincidunt diam, at vestibulum massa rutrum nec. Aliquam eu mauris est. Fusce eleifend ut enim sed porta. Nam cursus ornare ligula non semper. Integer fringilla venenatis ipsum sed feugiat. Morbi dapibus ipsum sapien, id rutrum eros porta lobortis.

                Etiam odio sem, pulvinar in tortor eget, dapibus condimentum sem. Quisque in neque at nunc eleifend vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam sit amet justo ac ante maximus posuere vitae a augue. In est libero, placerat sed dui a, gravida convallis tortor. Aliquam ac consequat nibh, sit amet vestibulum elit. Aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer arcu felis, imperdiet non odio efficitur, blandit fermentum arcu."
            ),
            array(
                new \DateTime(),
                "Episode 3",
                "Proin vitae lacus a quam convallis egestas. Suspendisse placerat, diam id sodales rhoncus, odio sapien ultricies leo, varius laoreet dui velit eu augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla viverra posuere aliquet. Vivamus faucibus felis a tortor commodo, auctor aliquam nisi porttitor. Morbi a lectus vel urna rutrum varius. Mauris imperdiet nec magna at lacinia. Nam at ultricies mauris. Vestibulum nunc purus, semper ac nibh et, posuere convallis est. Vestibulum laoreet libero in justo vehicula consectetur. Donec tincidunt, arcu ut scelerisque finibus, eros augue dapibus enim, eu pretium elit dui a magna. In viverra, arcu ut euismod ultrices, erat lectus iaculis mi, quis fringilla neque arcu et erat. Etiam orci massa, tristique vel urna eu, efficitur laoreet leo.

                Donec eleifend nibh nec magna finibus congue. Curabitur eu mauris lectus. Mauris ut lacus ultrices, hendrerit nisl ut, convallis neque. Vivamus eget suscipit nisi, eu dignissim ipsum. Donec quis cursus enim. Morbi tempus lobortis nulla, ut fermentum mi tempus in. Sed laoreet, ipsum at aliquam lobortis, diam orci vestibulum ante, at facilisis orci quam in est. Integer lacus augue, congue non vehicula eu, porttitor sed ante. Aliquam fringilla mollis quam a rutrum.

                Sed ultricies purus eros, vitae imperdiet felis elementum mattis. Aenean urna arcu, consequat viverra nulla ut, aliquam tempus mauris. Suspendisse euismod laoreet erat laoreet lacinia. Nulla ornare gravida dui et tristique. Nunc fermentum lorem et magna eleifend, id posuere ex pharetra. Donec ornare justo turpis, eget malesuada mauris accumsan ut. Curabitur ultrices sem vestibulum sodales tempus. Aliquam vel ex dapibus, volutpat nulla eu, placerat sapien. Morbi pulvinar, augue non iaculis efficitur, sapien ex vehicula enim, id fermentum mi mi ac purus. Cras feugiat, sapien nec aliquet laoreet, sapien eros imperdiet dui, ut accumsan arcu magna nec mi. Nulla luctus tristique nulla sed auctor.

                Vestibulum ac sem aliquam, blandit enim vitae, gravida ipsum. Duis tincidunt est dolor, id egestas diam tempus sit amet. Sed tincidunt malesuada sapien, et iaculis nibh ultrices et. Aliquam maximus, libero quis dapibus tempus, arcu lorem semper orci, et hendrerit dolor eros auctor lectus. Aliquam sit amet tempus turpis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse vulputate et sem id ullamcorper. Curabitur at magna sit amet diam mollis ultrices. Morbi gravida vitae augue sit amet convallis. Cras vestibulum id ipsum non finibus. Fusce ut libero ut enim bibendum bibendum vel fermentum lacus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer turpis urna, tempor id mi vitae, posuere vulputate tortor. Sed scelerisque tortor dui, sit amet porttitor justo gravida facilisis. Cras non enim felis.

                Curabitur at lectus vitae elit pretium efficitur eu et nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras mattis elit at ligula blandit, vel accumsan odio commodo. In et ornare nunc, et sodales erat. Nullam sapien est, pulvinar at augue ac, ullamcorper facilisis felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam ante ante, elementum ac velit aliquet, facilisis consequat mauris. Duis a odio quis lorem feugiat ullamcorper."
            ),
            array(
                new \DateTime(),
                "Episode 4",
                "In quis orci vitae ipsum tincidunt dapibus. Mauris feugiat nibh nec gravida bibendum. Etiam vel viverra odio, at varius turpis. Phasellus elit ante, pharetra non mattis in, porta non neque. Quisque fermentum dui non pharetra eleifend. Vivamus sit amet nunc risus. Vestibulum et tincidunt nisi, sed vehicula nulla. In ut quam odio. Sed nisi eros, sodales ut est quis, placerat ullamcorper libero. Mauris commodo dictum ultrices.

                Donec non rhoncus nunc. Sed quis risus in lorem faucibus aliquet eget ut sem. Sed vitae augue quis velit mollis vehicula vitae sed libero. Ut ullamcorper volutpat metus ornare suscipit. Nunc quis nulla nec nulla fermentum elementum et id dolor. Morbi lectus sem, maximus in orci ut, aliquam imperdiet nibh. Proin nunc elit, fringilla nec orci at, tincidunt condimentum risus. Cras tempus condimentum lorem, quis aliquet est luctus id. Donec vel risus dapibus augue facilisis imperdiet sed quis leo. Sed turpis quam, volutpat sed semper at, congue blandit nisl. Donec sagittis nibh volutpat tincidunt posuere. Proin et faucibus nibh, in semper augue.

                Vestibulum condimentum felis vel lobortis semper. Sed feugiat, quam eu volutpat faucibus, ante tortor dignissim est, eget vehicula metus risus sit amet est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec faucibus aliquet nunc, quis imperdiet lorem porta a. Duis at rhoncus lorem. Sed sem nisi, lobortis a nunc vitae, bibendum tincidunt lectus. Sed dictum cursus lacinia. Mauris malesuada placerat velit ut feugiat. Cras id neque ac felis tempus faucibus. Fusce sit amet justo tempor odio hendrerit ultrices. Cras id diam sed purus laoreet blandit. Nullam auctor turpis sed metus elementum, eget sagittis augue lobortis. Duis nec diam quis nibh lacinia placerat eu ac lorem.

                Nam ullamcorper bibendum varius. Pellentesque id elit a dolor mollis luctus. Proin aliquet eros in elementum dapibus. Maecenas eget risus eu neque ultrices porttitor vel et nisi. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi tempor varius orci, ac tristique mauris sollicitudin sit amet. Donec blandit turpis id ante sollicitudin, et tempor mauris volutpat. Duis et fermentum sapien, eu lacinia mi. Mauris id rutrum nibh. Fusce turpis nunc, blandit maximus neque in, feugiat luctus mi.

                Nunc vestibulum magna ligula, pulvinar rutrum velit condimentum non. Phasellus commodo tellus eleifend mi laoreet congue. Suspendisse eu sagittis velit, non viverra nibh. Nullam hendrerit convallis gravida. Aliquam a tellus neque. Morbi pretium vehicula quam a suscipit. Mauris vitae porttitor orci. Nunc mollis pellentesque urna vel faucibus. Duis sed mauris condimentum, dictum dolor et, scelerisque sem. Fusce elementum ac elit eu sodales. Suspendisse tempus justo sit amet feugiat ultrices. Sed malesuada metus sem, vel malesuada dui hendrerit quis. Duis mi nunc, ultricies eget sapien a, luctus interdum metus. Sed dictum odio eget consectetur sagittis. Pellentesque pulvinar ipsum vel ultricies porttitor. Praesent lacus nunc, laoreet imperdiet velit ac, consequat interdum quam."
            ),
            array(
                new \DateTime(),
                "Episode 5",
                "Duis libero diam, mattis at ante non, imperdiet tincidunt dui. Aliquam varius, metus quis tempus porta, odio enim posuere enim, at efficitur velit ex nec nisl. Mauris efficitur et magna id lacinia. Vestibulum sed facilisis magna, id hendrerit magna. Nullam blandit congue condimentum. Aenean id rhoncus est. Donec suscipit lectus augue, in consectetur leo hendrerit non. Duis vehicula eleifend consectetur. Mauris eget lacus faucibus, pellentesque lorem at, luctus ex. Morbi sed mauris non velit placerat aliquam nec vel lorem. Nunc mollis mauris metus, ac auctor sem laoreet a.

                Maecenas accumsan, odio in hendrerit ullamcorper, ex sem euismod tellus, nec convallis mauris lacus et ante. Mauris sit amet ligula tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam aliquam ante ut risus pretium commodo. Aenean pulvinar varius augue congue volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut metus et odio sollicitudin bibendum. Quisque magna magna, vestibulum id tincidunt ut, aliquam et magna. Donec aliquet felis magna, eu molestie libero eleifend volutpat. Fusce ut dolor lacinia, posuere purus ultricies, volutpat nisi. Aliquam sollicitudin, libero non volutpat convallis, metus nisi semper justo, id dapibus tortor ligula non tellus. Vestibulum ac vulputate metus.

                Morbi auctor turpis ut tristique ultricies. Nullam cursus dolor consequat mi pharetra auctor. Mauris non mollis justo. Nulla elementum mi quis ligula condimentum feugiat. Vivamus lobortis fringilla neque. Duis eget consequat metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam ornare ante at eros consequat, lacinia vestibulum justo facilisis. Etiam vehicula lectus ac rutrum lacinia. Morbi ultrices mauris lorem, vulputate ultricies ante dapibus quis. Integer iaculis sapien lacus, tempor dictum turpis mollis non. Aenean molestie quam nec velit ultrices, ac pharetra ipsum viverra. In a ultrices est. Morbi vestibulum diam elit, vel maximus justo suscipit non.

                Suspendisse potenti. Ut rutrum ex in augue mattis, ut tristique nisl bibendum. Nam a nisl et lectus lobortis venenatis. Vestibulum euismod congue erat. Sed tellus mauris, facilisis ut neque at, venenatis porta augue. Etiam venenatis eget est sit amet posuere. Quisque scelerisque, eros nec consequat imperdiet, odio ligula aliquet arcu, sit amet semper diam justo eu sem. Quisque et iaculis eros. Vestibulum vel quam sagittis, finibus ipsum eget, efficitur leo. Aliquam erat volutpat. Etiam eu fermentum mi. Etiam mollis velit odio, vitae suscipit libero suscipit malesuada. Sed bibendum tempor quam ut molestie.

                Curabitur vitae sodales mi, nec feugiat ex. In ornare ultricies vestibulum. Praesent ac risus eget sapien semper sodales vitae et leo. Cras enim ipsum, blandit at orci id, iaculis euismod velit. Sed id aliquam justo. Duis eu est a mauris aliquam tempus. Morbi nec mauris id velit eleifend semper a vitae dui. Nulla facilisi. Nam erat eros, egestas nec ornare eu, varius id nulla. Mauris lacinia mi in leo convallis tempus. Vestibulum vulputate, magna sit amet interdum dictum, neque enim tempor est, vel semper sapien augue at ipsum. Quisque lacinia orci vitae iaculis dignissim."
            ),
            array(
                new \DateTime(),
                "Episode 6",
                "Duis consectetur, risus quis consequat aliquet, ligula metus consectetur sem, non malesuada urna ipsum ac urna. Duis et tellus nisl. Aliquam auctor blandit tellus in facilisis. Suspendisse vel feugiat massa. Maecenas lectus diam, tristique vitae erat vel, pulvinar ultricies nisl. Fusce aliquet nisi id luctus volutpat. Vivamus vitae malesuada mi. Aliquam erat volutpat.

                Vestibulum aliquet nisl sit amet ligula hendrerit tincidunt. Proin vel suscipit libero. Etiam cursus massa sit amet massa fermentum luctus. Suspendisse at metus ante. Aliquam volutpat semper enim in gravida. Aenean accumsan sapien convallis tellus vulputate faucibus. Vivamus accumsan, metus vitae pulvinar dignissim, nunc massa imperdiet nisi, in facilisis arcu nunc ut urna. Suspendisse potenti. Suspendisse vitae congue sapien. Donec tristique dictum nisl quis pulvinar. Aliquam porttitor elementum congue. Vestibulum commodo dui ullamcorper, tristique tortor vitae, euismod orci. In sit amet sodales nisi, et aliquet nisl.

                Cras ac libero a purus euismod condimentum. Sed sed metus ac nulla laoreet iaculis nec id lacus. Aenean vel condimentum mauris. Duis tempus sit amet risus mollis ullamcorper. Pellentesque dolor nunc, mollis nec lectus a, finibus suscipit risus. Suspendisse mollis quam ut lacus ultrices, non varius dui dapibus. Quisque sit amet ipsum nulla. Suspendisse pulvinar ligula dolor, et pulvinar mi hendrerit sed. Praesent ac odio augue. Vivamus tellus velit, sodales et tempus nec, congue quis est. Praesent ut elit nunc.

                Nullam auctor, metus sed feugiat feugiat, enim justo posuere ante, vel blandit enim arcu quis velit. Suspendisse luctus libero in mi lacinia, at volutpat velit tempor. Maecenas dignissim orci sed odio interdum mattis. Aenean tincidunt turpis ipsum, quis placerat felis vehicula quis. Aliquam bibendum congue mauris a interdum. Duis tristique pellentesque orci sit amet dapibus. Sed ultricies magna eget facilisis faucibus. Cras consequat interdum mollis. Vivamus diam nulla, tempus vel dapibus vel, tempor vel risus. Ut ac mattis lacus. Cras ullamcorper sagittis volutpat. Duis dui tortor, congue convallis maximus non, vestibulum sed ante. Etiam pharetra imperdiet purus ut tristique. Vivamus ipsum sapien, lacinia a diam id, hendrerit vehicula libero. Donec egestas, mi a consectetur sagittis, augue dolor fermentum nisi, vitae laoreet tellus orci vitae neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.

                Nullam at dolor augue. Vestibulum est dolor, vestibulum ac gravida sed, dignissim vitae lorem. Fusce tincidunt odio tortor, id ullamcorper sapien sagittis in. In sit amet turpis erat. Sed commodo quis velit vel ornare. Suspendisse a pharetra justo. Fusce auctor, odio nec malesuada dictum, velit sapien pulvinar erat, eget ultricies quam lorem quis nulla."
            )
        );

        foreach ($billets as $billet)
        {
            $newBillet = new Billet();

            foreach ($billet as $cle => $valeur)
            {
                switch ($cle)
                {
                    case 0:
                        $newBillet->setDateUpadte($valeur);
                        break;
                    case 1:
                        $newBillet->setTitle($valeur);
                        break;
                    case 2:
                        $newBillet->setContent($valeur);
                        break;
                }
            }

            $manager->persist($newBillet);
        }

        $manager->flush();
    }
}
