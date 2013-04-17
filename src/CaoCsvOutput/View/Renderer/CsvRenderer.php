<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Raymond J. Kolbe <raymond.kolbe@maine.edu>
 * @copyright Copyright (c) 2012 University of Maine
 * @license	http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace CaoCsvOutput\View\Renderer;

use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use CaoCsvOutput\Model\Csv;

class CsvRenderer implements Renderer
{
    private $resolver = null;
    
    public function getEngine()
    {
        return null;
    }
    
    /**
     * Renders as CSV
     *
     * @param  string|Model $name The script/resource process, or a view model
     * @param  null|array|\ArrayAccess Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        $content    = $nameOrModel->getVariable('content', array());
        $delimiter  = $nameOrModel->getOption('delimiter');
        $enclosure  = $nameOrModel->getOption('enclosure');
        $encloseAll = $nameOrModel->getOption('encloseAll');
        
        $csv = new Csv($content, $delimiter, $enclosure, $encloseAll);
        
        return $csv->render();
    }

    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;
        return $this;
    }
}
